<?php

use Illuminate\Database\Seeder;
use App\PresencaAluno;

class PresencaAlunoSeeder extends Seeder
{
    public function run()
    {
        factory(PresencaAluno::class, 10)->create();
    }
}
