<?php

use Illuminate\Database\Seeder;
use App\PresencaAluno;

class PresencaAlunoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        PresencaAluno::create(['plano_id' => 1, 'aluno_id' => 1,  'created_at' => now(), 'updated_at' => now()]);
    }
}
