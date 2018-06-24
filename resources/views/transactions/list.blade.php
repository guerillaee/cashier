
<tr class="@if($transaction->refund) refunded @endif">
  <td>{{ $transaction->id }}</td>
  <td>{{ $transaction->created_at }}</td>
  <td>{{ $transaction->category->name_ua }}</td>
  @if($transaction->category->type == 1)
    <td><span class="text-success">{{ $transaction->amount }}</span></td>
    <td></td>
  @else
    <td></td>
    <td><span class="text-danger">{{ $transaction->amount }}</span></td>
  @endif
  <td>{{ $transaction->refund }}</td>
  <td>
    @if(!$transaction->refund)
      <span class="refund" data-id="{{ $transaction->id }}">x</span>
    @endif
  </td>
</tr>
