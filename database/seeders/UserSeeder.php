<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;  // <- precisa estar aqui

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'     => 'Fernando de Cristo',
            'email'    => 'fernando.cristo@iffarroupilha.edu.br',
            'matricula' => '000000',
            'tipo' => 1,
            'cpf' => '000.000.000-00',
            'bloqueio' => 0,
            'password' => bcrypt('password'),
        ]);
    }
}
