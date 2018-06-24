@extends('app')

@section('content')
    <nav class="nav">
      <a class="nav-link" href="{{ route('transactions.create') }}">Створити транзакцію</a>
    </nav>
    <div class="alert" id="notification"></div>
    <ul class="nav nav-tabs">
      <li  class="nav-item">
        <a class="nav-link active" data-toggle="tab"  href="#cash_account">Готівковий рахунок, баланс - {{ $cash_total }}</a>
      </li>
      <li  class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#noncash_account">Безготівковий рахунок, баланс - {{ $noncash_total }}</a>
      </li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane fade show active" id="cash_account" role="tabpanel">
        <table class="table" >
            @include('transactions.table_header')
          <tbody>
            @forelse($cash_transactions as $transaction)
              @include('transactions.list', [ 'account' => 1 ])
            @empty
              <tr>
                <td>Транзакції відсутні</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
      <div class="tab-pane" id="noncash_account" role="tabpanel">
        <table class="table">
          @include('transactions.table_header')
          <tbody>
            @forelse($noncash_transactions as $transaction)
              @include('transactions.list', [ 'account' => 2 ])
            @empty
              <tr>
                <td>Транзакції відсутні</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
@endsection
