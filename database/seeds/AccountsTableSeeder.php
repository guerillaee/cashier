<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('accounts')->insert([
             'cash' => 1,
             'cashier_id' => 1
           ]);
         DB::table('accounts')->insert(
           [
             'cash' => 0,
             'cashier_id' => 1
           ]);
    }
}
