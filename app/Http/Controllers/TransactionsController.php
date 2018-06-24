<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\Category;
use App\Account;

class TransactionsController extends Controller
{
    private $between_account_operations = [4, 7];


    public function index()
    {
      $cash_transactions = Account::transactions(1);
      $noncash_transactions = Account::transactions(2);

      return view('transactions.index', [
                  'cash_transactions' => $cash_transactions,
                  'noncash_transactions' => $noncash_transactions,
                  'cash_total' => Account::amount(1),
                  'noncash_total' => Account::amount(2)
                ]);
    }

    public function create()
    {
      return view('transactions.create', [
        'cash_add_categories'  => $this->replenish_categories(),
        'cash_expense_categories'  => $this->expense_categories(),
        'noncash_add_categories'  => $this->replenish_categories(2),
        'noncash_expense_categories'  => $this->expense_categories(2)
      ]);
    }

    public function store(Request $request)
    {
       $data = array();

       if(empty( $request->input('amount'))){
         flash('Вкажіть суму тразакції')->warning();
         return redirect()->action('TransactionsController@create');
       }

       $data['amount'] = $request->input('amount');
       $account_id = $request->input('account_id');
       $operation_type = $request->input('operation_type');
       $data['category_id'] = $this->getCategoryId($account_id, $request);

       if($operation_type == 1){
           $data['creditor_account_id'] = $account_id;
       } else {
           if($this->isInvalidAmount($data['amount'], $account_id)){
              flash('Сума транзакції не може бути більша ніж баланс рахунку!')->warning();
              return redirect()->action('TransactionsController@create');
           }

           $data['debitor_account_id'] = $account_id;
       }

       if(in_array($data['category_id'], $this->between_account_operations)){
         return $this->storeBetweenAccount($data);
       }

       if(Transaction::create($data)){
          $this->updateAccountAmount($account_id, $data['amount'], $operation_type);
       }

       return redirect()->action('TransactionsController@index');
    }

    private function storeBetweenAccount($data)
    {
      if($data['category_id'] == 7){
        $data['debitor_account_id'] = 1;
        if(Transaction::create($data)){
           $this->updateAccountAmount(2, $data['amount'], true);
           $this->updateAccountAmount(1, $data['amount']);
        }
      } elseif($data['category_id'] == 4){
        $data['debitor_account_id'] = 2;
        if(Transaction::create($data)){
           $this->updateAccountAmount(1, $data['amount'], true);
           $this->updateAccountAmount(2, $data['amount']);
        }
      }

      return redirect()->action('TransactionsController@index');
    }

    public function updateAccountAmount($account_id, $amount, $operation_type = false)
    {
      $account = Account::findOrFail($account_id);
      $account->amount = $operation_type ? ($account->amount + $amount) : ($account->amount - $amount);
      $account->timestamps = false;
      $account->save();
    }

    private function isInvalidAmount($amount, $account_id)
    {
      $account = Account::findOrFail($account_id);
      return ($account->amount - $amount) < 0;
    }

    private function getCategoryId($account_id, $request)
    {
      $category_id = null;

      if($account_id == 1){
        if($request->input('cash_add_category_id')){
            $category_id = $request->input('cash_add_category_id');
        } elseif ($request->input('cash_dis_category_id')) {
            $category_id = $request->input('cash_dis_category_id');
        }
      } else {
        if($request->input('noncash_add_category_id')){
            $category_id = $request->input('noncash_add_category_id');
        } elseif ($request->input('noncash_dis_category_id')) {
            $category_id = $request->input('noncash_dis_category_id');
        }
      }

      return $category_id;
    }

    public function replenish_categories($account_id = 1)
    {
      $cash_categories = array();

      $categories = Category::select('id', 'name_ua')->where('type', 1)->where('account_id', $account_id)->get();

      foreach($categories as $category){
        $cash_categories[$category->id] = $category->name_ua;
      }

      return $cash_categories;
    }

    public function expense_categories($account_id = 1)
    {
      $noncash_categories = array();

      $categories = Category::select('id', 'name_ua')->where('type', 0)->where('account_id', $account_id)->get();

      foreach($categories as $category){
        $noncash_categories[$category->id] = $category->name_ua;
      }

      return $noncash_categories;
    }

    public function refund(Request $request)
    {
      if(empty($request->input('id'))){
          return response()->json(['error'=>'Помилка!']);
      }

      $transaction = Transaction::findorFail($request->input('id'));

      if(!empty($transaction->creditor_account_id) && !empty($transaction->debitor_account_id)){
        $this->updateAccountAmount($transaction->debitor_account_id,  $transaction->amount, true);
        $this->updateAccountAmount($transaction->creditor_account_id, $transaction->amount);
      } else {
        $account_id = $transaction->creditor_account_id ? $transaction->creditor_account_id : $transaction->debitor_account_id;
        $type = $transaction->category->type ? 0 : 1;
        $this->updateAccountAmount($account_id, $transaction->amount, $type);
      }

      $this->setRefundStatus($transaction);

      return response()->json(['success'=>'Транзакція успішно відмінена!']);
    }

    private function setRefundStatus($transaction)
    {
      $transaction->refund = 1;
      return $transaction->save();
    }
}
