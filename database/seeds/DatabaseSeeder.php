<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call([UsersTableSeeder::class]);
        $this->call([AlunoSeeder::class]);
        $this->call([CategoriaSeeder::class]);
        $this->call([PlanoSeeder::class]);
        $this->call([AlunoplanoSeeder::class]);
        $this->call([AluguelSeeder::class]);
        $this->call([PresencaAlunoSeeder::class]);
    }
}
