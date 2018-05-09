<?php

use Illuminate\Database\Seeder;

class StocksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stocks')->insert(['ticker' => 'PETR4']);
        DB::table('stocks')->insert(['ticker' => 'VALE3']);
        DB::table('stocks')->insert(['ticker' => 'SAPR4']);
        DB::table('stocks')->insert(['ticker' => 'VULC3']);
        DB::table('stocks')->insert(['ticker' => 'SMTO3']);
        DB::table('stocks')->insert(['ticker' => 'PMAM3']);
        DB::table('stocks')->insert(['ticker' => 'ITSA4']);
        DB::table('stocks')->insert(['ticker' => 'BRFS3']);
        DB::table('stocks')->insert(['ticker' => 'MDIA3']);
        DB::table('stocks')->insert(['ticker' => 'CIEL3']);
        DB::table('stocks')->insert(['ticker' => 'CARD3']);
        DB::table('stocks')->insert(['ticker' => 'FRAS3']);
        DB::table('stocks')->insert(['ticker' => 'CCRO3']);
        DB::table('stocks')->insert(['ticker' => 'BBAS3']);
        DB::table('stocks')->insert(['ticker' => 'BBSE3']);
        DB::table('stocks')->insert(['ticker' => 'MPLU3']);
        DB::table('stocks')->insert(['ticker' => 'ITUB4']);
        DB::table('stocks')->insert(['ticker' => 'BBDC4']);
        DB::table('stocks')->insert(['ticker' => 'GOAU4']);
        DB::table('stocks')->insert(['ticker' => 'QUAL3']);
    }
}

