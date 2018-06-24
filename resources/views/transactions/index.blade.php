<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Document</title>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
  <div class="container">
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
              @include('transactions.list')
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
              @include('transactions.list')
            @empty
              <tr>
                <td>Транзакції відсутні</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <script type="text/javascript">

  </script>
</body>
</html>
