<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $categories = [
          ['name' => 'cash_sale_without_check', 'type' => 1],
          ['name' => 'sale_with_goods_delivery', 'type' => 1],
          ['name' => 'online_sale', 'type' => 1],
          ['name' => 'withdrawal_non_cash_account', 'type' => 1],
          ['name' => 'ecquiring_sale', 'type' => 1],
          ['name' => 'other_noncash_addition', 'type' => 1],
          ['name' => 'withdrawal_cash_account', 'type' => 1],
          ['name' => 'goods_return', 'type' => 0],
          ['name' => 'goods_purchase', 'type' => 0],
          ['name' => 'other_cash_expenses', 'type' => 0],
          ['name' => 'bank_services', 'type' => 0],
          ['name' => 'other_noncash_expenses', 'type' => 0],
      ];

      foreach($categories as $category){
        DB::table('categories')->insert($category);
      }
    }
}
