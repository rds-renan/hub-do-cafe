<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class NewsaletterController extends Controller
{
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'email' => 'required|email:rfc,dns|unique:newsletter_subscribers,email'
            ]);

            NewsletterSubscriber::create($data);

            return redirect()->to(url()->previous() . '#newsletter')
                ->with('success', 'Obrigado! Cadastro confirmado.');

        } catch (ValidationException $e) {
            return redirect()->to(url()->previous() . '#newsletter')
                ->withErrors($e->validator)
                ->withInput();
        }
    }
}
