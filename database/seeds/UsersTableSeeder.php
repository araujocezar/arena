<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Suporte Arena',
            'email' => 'suporte@arenadasflores.com.br',
            'email_verified_at' => now(),
            'password' => Hash::make('arena@suporte'),
            'admin' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('users')->insert([
            'name' => 'Lucas Admin',
            'email' => 'lucas@arenadasflores.com.br',
            'email_verified_at' => now(),
            'password' => Hash::make('arena@admin'),
            'admin' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('users')->insert([
            'name' => 'Funcionário Arena',
            'email' => 'funcionario@arenadasflores.com.br',
            'email_verified_at' => now(),
            'password' => Hash::make('arena@funcionario'),
            'admin' => 0,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
    
}
