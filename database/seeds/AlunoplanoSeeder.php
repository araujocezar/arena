<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlunoplanoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('aluno_plano')->insert([
            'aluno_id' => '1',
            'plano_id' => '1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('aluno_plano')->insert([
            'aluno_id' => '1',
            'plano_id' => '2',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('aluno_plano')->insert([
            'aluno_id' => '2',
            'plano_id' => '1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('aluno_plano')->insert([
            'aluno_id' => '2',
            'plano_id' => '5',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('aluno_plano')->insert([
            'aluno_id' => '2',
            'plano_id' => '5',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('aluno_plano')->insert([
            'aluno_id' => '2',
            'plano_id' => '3',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
