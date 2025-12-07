<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AddressController extends Controller
{
    /**
     * Lista todos os endereços do usuário autenticado
     */
    public function index(): JsonResponse
    {
        $addresses = Auth::user()->addresses()->orderByDesc('is_default')->get();

        return response()->json([
            'success' => true,
            'addresses' => $addresses,
        ]);
    }

    /**
     * Salva um novo endereço
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'label' => 'required|string|max:50',
            'zipcode' => 'required|string|max:9',
            'street' => 'required|string|max:255',
            'number' => 'required|string|max:20',
            'complement' => 'nullable|string|max:100',
            'neighborhood' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'state' => 'required|string|size:2',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'is_default' => 'boolean',
        ]);

        $validated['user_id'] = Auth::id();

        // Se for o primeiro endereço ou marcado como padrão
        $isFirstAddress = Auth::user()->addresses()->count() === 0;

        if ($isFirstAddress || ($validated['is_default'] ?? false)) {
            // Remove is_default dos outros endereços
            Auth::user()->addresses()->update(['is_default' => false]);
            $validated['is_default'] = true;
        }

        $address = Address::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Endereço salvo com sucesso!',
            'address' => $address,
        ], 201);
    }

    /**
     * Atualiza um endereço existente
     */
    public function update(Request $request, Address $address): JsonResponse
    {
        // Verifica se o endereço pertence ao usuário
        if ($address->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Endereço não encontrado.',
            ], 404);
        }

        $validated = $request->validate([
            'label' => 'sometimes|required|string|max:50',
            'zipcode' => 'sometimes|required|string|max:9',
            'street' => 'sometimes|required|string|max:255',
            'number' => 'sometimes|required|string|max:20',
            'complement' => 'nullable|string|max:100',
            'neighborhood' => 'sometimes|required|string|max:100',
            'city' => 'sometimes|required|string|max:100',
            'state' => 'sometimes|required|string|size:2',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'is_default' => 'boolean',
        ]);

        // Se marcando como padrão, remove dos outros
        if ($validated['is_default'] ?? false) {
            Auth::user()->addresses()
                ->where('id', '!=', $address->id)
                ->update(['is_default' => false]);
        }

        $address->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Endereço atualizado com sucesso!',
            'address' => $address->fresh(),
        ]);
    }

    /**
     * Remove um endereço
     */
    public function destroy(Address $address): JsonResponse
    {
        // Verifica se o endereço pertence ao usuário
        if ($address->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Endereço não encontrado.',
            ], 404);
        }

        $wasDefault = $address->is_default;
        $address->delete();

        // Se era o padrão, define outro como padrão
        if ($wasDefault) {
            $newDefault = Auth::user()->addresses()->first();
            if ($newDefault) {
                $newDefault->update(['is_default' => true]);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Endereço removido com sucesso!',
        ]);
    }

    /**
     * Define um endereço como padrão
     */
    public function setDefault(Address $address): JsonResponse
    {
        // Verifica se o endereço pertence ao usuário
        if ($address->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Endereço não encontrado.',
            ], 404);
        }

        $address->setAsDefault();

        return response()->json([
            'success' => true,
            'message' => 'Endereço definido como padrão!',
        ]);
    }
}
