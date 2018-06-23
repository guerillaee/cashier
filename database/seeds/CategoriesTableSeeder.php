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
          ['name' => 'cash_sale_without_check', 'name_ua' => 'Готівковий продаж без чеку', 'type' => 1, 'account_id' => 1],
          ['name' => 'sale_with_goods_delivery', 'name_ua' => 'Продаж з відправленням товару', 'type' => 1, 'account_id' => 1],
          ['name' => 'online_sale', 'name_ua' => 'Продаж онлайн', 'type' => 1, 'account_id' => 1],
          ['name' => 'withdrawal_non_cash_account', 'name_ua' => 'Зняття коштів з безготівкового рахунку', 'type' => 1, 'account_id' => 1],
          ['name' => 'ecquiring_sale', 'name_ua' => 'Продаж по еквайрингу', 'type' => 1, 'account_id' => 2],
          ['name' => 'other_noncash_addition', 'name_ua' => 'Інші поповнення безготівкового рахунку', 'type' => 1, 'account_id' => 2],
          ['name' => 'withdrawal_cash_account', 'name_ua' => 'Поповнення рахунку з готівкового', 'type' => 1, 'account_id' => 2],
          ['name' => 'goods_return', 'name_ua' => 'Повернення товару', 'type' => 0, 'account_id' => 1],
          ['name' => 'goods_purchase', 'name_ua' => 'Закупка нового товару', 'type' => 0, 'account_id' => 1],
          ['name' => 'other_cash_expenses', 'name_ua' => 'Інші витрати', 'type' => 0, 'account_id' => 1],
          ['name' => 'bank_services', 'name_ua' => 'Послуги банку', 'type' => 0, 'account_id' => 2],
          ['name' => 'other_noncash_expenses', 'name_ua' =>'Інші витрати', 'type' => 0, 'account_id' => 2],
      ];

      foreach($categories as $category){
        DB::table('categories')->insert($category);
      }
    }
}
