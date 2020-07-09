<?php

use Illuminate\Database\Seeder;

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
            'dias_restantes' => '2',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('aluno_plano')->insert([
            'aluno_id' => '1',
            'plano_id' => '2',
            'dias_restantes' => '2',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('aluno_plano')->insert([
            'aluno_id' => '2',
            'plano_id' => '1',
            'dias_restantes' => '2',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('aluno_plano')->insert([
            'aluno_id' => '2',
            'plano_id' => '5',
            'dias_restantes' => '2',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('aluno_plano')->insert([
            'aluno_id' => '2',
            'plano_id' => '5',
            'dias_restantes' => '2',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('aluno_plano')->insert([
            'aluno_id' => '2',
            'plano_id' => '3',
            'dias_restantes' => '2',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
