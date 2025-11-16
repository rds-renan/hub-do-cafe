<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin Hub',
            'email' => 'admin@hubdocafe.rds.dev.br',
            'password' => Hash::make('Admin#147'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'Cliente Teste',
            'email' => 'cliente@teste.com',
            'password' => Hash::make('Client@258'),
            'role' => 'client'
        ]);

        User::create([
            'name' => 'Atendente Teste',
            'email' => 'atendente@hubdocafe.rds.dev.br',
            'password' => Hash::make('Atendente#369'),
            'role' => 'employee'
        ]);

        User::create([
            'name' => 'Entregador Teste',
            'email' => 'entregador@hubdocafe.rds.dev.br',
            'password' => Hash::make('Entregador#470'),
            'role' => 'deliveryman'
        ]);
    }
}
