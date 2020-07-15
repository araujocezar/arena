<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

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
            'data_expiracao' => (new Carbon())->addMonths(1),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('aluno_plano')->insert([
            'aluno_id' => '1',
            'plano_id' => '2',
            'data_expiracao' => (new Carbon())->addMonths(6),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('aluno_plano')->insert([
            'aluno_id' => '2',
            'plano_id' => '1',
            'data_expiracao' => (new Carbon())->addMonths(3),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('aluno_plano')->insert([
            'aluno_id' => '2',
            'plano_id' => '5',
            'data_expiracao' => (new Carbon())->addMonths(12),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('aluno_plano')->insert([
            'aluno_id' => '2',
            'plano_id' => '5',
            'data_expiracao' => (new Carbon())->addMonths(6),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('aluno_plano')->insert([
            'aluno_id' => '2',
            'plano_id' => '3',
            'data_expiracao' => (new Carbon())->addMonths(1),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
