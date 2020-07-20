<?php

use Illuminate\Database\Seeder;

class PlanoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(App\Plano::class, 16)->create();
        DB::table('planos')->insert([
            'descricao' =>'Funcional 2',
            'dias_semana' => '2',
            'preco' => '110',
            'preco_trimestral' => '100',
            'preco_semestral' => '90',
            'categoria_id' => '2'
        ]);

        DB::table('planos')->insert([
            'descricao' =>'Funcional 3',
            'dias_semana' => '3',
            'preco' => '130',
            'preco_trimestral' => '115',
            'preco_semestral' => '100',
            'categoria_id' => '2'
        ]);

        DB::table('planos')->insert([
            'descricao' =>'Funcional 4',
            'dias_semana' => '4',
            'preco' => '150',
            'preco_trimestral' => '135',
            'preco_semestral' => '120',
            'categoria_id' => '2'
        ]);

        DB::table('planos')->insert([
            'descricao' =>'Funcional 5',
            'dias_semana' => '5',
            'preco' => '160',
            'preco_trimestral' => '145',
            'preco_semestral' => '130',
            'categoria_id' => '2'
        ]);

        DB::table('planos')->insert([
            'descricao' =>'Futevolei 2',
            'dias_semana' => '2',
            'preco' => '100',
            'preco_trimestral' => '90',
            'preco_semestral' => '80',
            'categoria_id' => '1'
        ]);

        DB::table('planos')->insert([
            'descricao' =>'Futevolei 3',
            'dias_semana' => '3',
            'preco' => '120',
            'preco_trimestral' => '105',
            'preco_semestral' => '90',
            'categoria_id' => '1'
        ]);

        DB::table('planos')->insert([
            'descricao' =>'Futevolei 4',
            'dias_semana' => '4',
            'preco' => '140',
            'preco_trimestral' => '120',
            'preco_semestral' => '105',
            'categoria_id' => '1'
        ]);

        DB::table('planos')->insert([
            'descricao' =>'Combo 3',
            'dias_semana' => '3',
            'preco' => '150',
            'preco_trimestral' => '135',
            'preco_semestral' => '120',
            'categoria_id' => '3'
        ]);

        DB::table('planos')->insert([
            'descricao' =>'Combo 4',
            'dias_semana' => '4',
            'preco' => '180',
            'preco_trimestral' => '165',
            'preco_semestral' => '150',
            'categoria_id' => '3'
        ]);


        DB::table('planos')->insert([
            'descricao' =>'Combo 5',
            'dias_semana' => '5',
            'preco' => '200',
            'preco_trimestral' => '185',
            'preco_semestral' => '170',
            'categoria_id' => '3'
        ]);
    }
}
