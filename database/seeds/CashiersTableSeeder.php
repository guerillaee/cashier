<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CashiersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('cashiers')->insert(['name' => 'Cashier']);
    }
}
