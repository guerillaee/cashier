<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Document</title>
  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
  <div class="container">
    {!! Form::open(['route' => 'transactions.store', 'class' => 'form']) !!}
    <div class="row">
      <div class="col-md-6">
        {!! Form::label('operation_type', 'Поповнити') !!}
        {!! Form::radio('operation_type', 'add', true, ['id' => 'add_operation']) !!}
      </div>
      <div class="col-md-6">
        {!! Form::label('operation_type', 'Списати') !!}
        {!! Form::radio('operation_type', 'expense', false, ['id' => 'expense_operation']) !!}
      </div>
      <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('cash_type', 'Операції поповнення') !!}
            {!! Form::select('cash_type', $cash_categories, null, ['class' => 'form-control', 'placeholder'=>'Please select ...']); !!}
        </div>
        <div class="form-group">
            {!! Form::label('cash_type', 'Операції поповнення') !!}
            {!! Form::select('cash_type', $cash_categories, null, ['class' => 'form-control', 'placeholder'=>'Please select ...']); !!}
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('noncash_type', 'Операції списання') !!}
            {!! Form::select('noncash_type', $noncash_categories, null, ['class' => 'form-control', 'placeholder'=>'Please select ...']); !!}
        </div>
      </div>

    <div class="col-md-6">
      <div class="form-group">
          {!! Form::label('name', 'Сумма') !!}
          {!! Form::number('amount', null, ['class' => 'form-control']) !!}
      </div>
    </div>
    <div class="col-md-12">
      {!! Form::submit('Створити транзакцію', ['class' => 'btn btn-info']) !!}

      {!! Form::close() !!}
    </div>
    </div>

  </div>
</body>
</html>
