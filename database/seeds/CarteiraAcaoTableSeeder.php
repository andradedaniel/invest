<?php

use Illuminate\Database\Seeder;

class CarteiraAcaoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('carteira_acoes')->insert([
            'user_id' => 1,
            'tipo' => 'C',
            'acao_id' =>'11', //card3
            'date' => '2017-05-16',
            'qtd' => 500,
            'preco' => 10.10,
            'taxa' => 3.12,
            'valor_operacao' => 5050,
            'lucro' => null,
            'qtd_atual' => 500,
            'pm_atual' => 10.11,
            'qtd_anterior' => 0,
            'pm_anterior' => 10.11,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('carteira_acoes')->insert([
            'user_id' => 1,
            'tipo' => 'C',
            'acao_id' =>'7', //itsa4
            'date' => '2017-05-18',
            'qtd' => 200,
            'preco' => 9,
            'taxa' => 2.16,
            'valor_operacao' => 1800,
            'lucro' => null,
            'qtd_atual' => 200,
            'pm_atual' => 9.01,
            'qtd_anterior' => 0,
            'pm_anterior' => 9.01,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('carteira_acoes')->insert([
            'user_id' => 1,
            'tipo' => 'C',
            'acao_id' =>'1', //petr4
            'date' => '2017-05-18',
            'qtd' => 200,
            'preco' => 13.85,
            'taxa' => 2.16,
            'valor_operacao' => 2770,
            'lucro' => null,
            'qtd_atual' => 200,
            'pm_atual' => 13.86,
            'qtd_anterior' => 0,
            'pm_anterior' => 13.86,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('carteira_acoes')->insert([
            'user_id' => 1,
            'tipo' => 'C',
            'acao_id' =>'3', //sapr4
            'date' => '2017-05-18',
            'qtd' => 200,
            'preco' => 10,
            'taxa' => 2.16,
            'valor_operacao' => 2000,
            'lucro' => null,
            'qtd_atual' => 200,
            'pm_atual' => 10.01,
            'qtd_anterior' => 0,
            'pm_anterior' => 10.01,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('carteira_acoes')->insert([
            'user_id' => 1,
            'tipo' => 'C',
            'acao_id' =>'1', //petr4
            'date' => '2017-08-10',
            'qtd' => 200,
            'preco' => 13.23,
            'taxa' => 1.63,
            'valor_operacao' => 2646,
            'lucro' => null,
            'qtd_atual' => 400,
            'pm_atual' => 13.55,
            'qtd_anterior' => 200,
            'pm_anterior' => 13.86,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('carteira_acoes')->insert([
            'user_id' => 1,
            'tipo' => 'V',
            'acao_id' =>'1', //petr4
            'date' => '2017-08-22',
            'qtd' => 400,
            'preco' => 13.80,
            'taxa' => 3.27,
            'valor_operacao' => 5520,
            'lucro' => 96.94,
            'qtd_atual' => 0,
            'pm_atual' => 13.55,
            'qtd_anterior' => 400,
            'pm_anterior' => 13.86,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
