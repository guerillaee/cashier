<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
  <div class="container">
    <nav class="nav">
      <a class="nav-link" href="{{ route('transactions.create') }}">Створити транзакцію</a>
    </nav>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Час транзакції</th>
          <th scope="col">Категорія</th>
          <th scope="col">Поповнення</th>
          <th scope="col">Витрати</th>
        </tr>
      </thead>
      <tbody>
        @forelse($transactions as $transaction)
            <tr>
            <td>{{ $transaction->id }}</td>
            <td>{{ $transaction->created_at }}</td>
            <td>{{ $transaction->category->name_ua }}</td>
            @if($transaction->creditor_account_id)
              <td><span class="text-success">{{ $transaction->amount }}</span></td>
              <td></td>
            @elseif ($transaction->debitor_account_id)
              <td></td>
              <td><span class="text-danger">{{ $transaction->amount }}</span></td>
            @endif
          @empty
            <td>Транзакції відсутні</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</body>
</html>
