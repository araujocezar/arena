<?php

use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorias')->insert([
            'tipo' => 'futvolei',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('categorias')->insert([
            'tipo' => 'funcional',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
