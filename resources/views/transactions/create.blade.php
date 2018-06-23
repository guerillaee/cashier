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
        <div class="col-md-12">
          {!! Form::label('account_type', 'Готівковий') !!}
          {!! Form::radio('account_id', '1', true, ['id' => 'cash_account']) !!}
          {!! Form::label('account_type', 'Безготівковий') !!}
          {!! Form::radio('account_id', '2', false, ['id' => 'noncahs_account']) !!}
       </div>
        <div class="col-md-6">
          {!! Form::label('operation_type', 'Поповнити') !!}
          {!! Form::radio('operation_type', 1, true, ['id' => 'add_operation']) !!}
        </div>
        <div class="col-md-6">
          {!! Form::label('operation_type', 'Списати') !!}
          {!! Form::radio('operation_type', 0, false, ['id' => 'expense_operation']) !!}
        </div>
       <div class="col-md-6 cash_list">
          <div class="form-group">
            {!! Form::label('cash_add_category_id', 'Операції поповнення') !!}
            {!! Form::select('cash_add_category_id', $cash_add_categories, null, ['id' => null, 'class' => 'form-control add_operations', 'placeholder'=>'Please select ...']); !!}
          </div>
        </div>
        <div class="col-md-6 cash_list">
          <div class="form-group">
              {!! Form::label('cash_dis_category_id', 'Операції списання') !!}
              {!! Form::select('cash_dis_category_id', $cash_expense_categories, null, ['id' => null, 'class' => 'form-control dispense_operations', 'placeholder'=>'Please select ...']); !!}
          </div>
        </div>
        <div class="col-md-6 noncash_list">
           <div class="form-group">
             {!! Form::label('noncash_add_category_id', 'Операції поповнення') !!}
             {!! Form::select('noncash_add_category_id', $noncash_add_categories, null, [ 'id' => null, 'class' => 'form-control add_operations', 'placeholder'=>'Please select ...']); !!}
           </div>
         </div>
         <div class="col-md-6 noncash_list">
           <div class="form-group">
               {!! Form::label('noncash_dis_category_id', 'Операції списання') !!}
               {!! Form::select('noncash_dis_category_id', $noncash_expense_categories, null, [ 'id' => null,'class' => 'form-control dispense_operations', 'placeholder'=>'Please select ...']); !!}
           </div>
         </div>
      <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('name', 'Сума') !!}
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
