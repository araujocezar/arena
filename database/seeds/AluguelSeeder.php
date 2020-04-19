<?php

use Illuminate\Database\Seeder;

class AluguelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Aluguel::class, 10)->create();
    }
}
