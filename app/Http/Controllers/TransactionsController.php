<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\Category;
use App\Account;

class TransactionsController extends Controller
{
    private $operation_type = [
                      'expense' => 0,
                      'add'     => 1
    ];

    public function index()
    {
      $transactions = Transaction::all();

      return view('transactions.index');
    }

    public function create()
    {
      return view('transactions.create', [
        'transaction' => [],
        'cash_categories'  => $this->cash_categories(),
        'noncash_categories'  => $this->noncash_categories(),
      ]);
    }

    public function store(Request $request)
    {
       // $transaction = Transaction::create($request->all());
dd($request->all());
      // if($request->input('category')){
      //     $transaction->category()->attach($request->input('category'));
      // }

      // return redirect()->route('transactions.index');
    }

    private function getOperationFields($request)
    {
      $data = [];

      if(!empty($request->input('cash_type'))){
          $data['category_id'] = $request->input('cash_type');
      }

      if(!empty($data['noncash_type'])){
          $data['category_id'] = $request->input('noncash_type');
      }

      // return $this->operation_type[$data['operation_type']];
    }

    public function cash_categories()
    {
      $cash_categories = array();

      $categories = Category::select('id', 'name_ua')->where('type', 1)->get();

      foreach($categories as $category){
        $cash_categories[$category->id] = $category->name_ua;
      }

      return $cash_categories;
    }

    public function noncash_categories()
    {
      $noncash_categories = array();

      $categories = Category::select('id', 'name_ua')->where('type', 0)->get();

      foreach($categories as $category){
        $noncash_categories[$category->id] = $category->name_ua;
      }

      return $noncash_categories;
    }
}
