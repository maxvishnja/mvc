@extends('layouts.account')

@section('pageClass', 'account account-transactions account-transaction')

@section('title', trans('account.transaction.title', ['id' => $order->getPaddedId()]))

@section('content')
	<h1>{{ trans('account.transaction.header', ['id' => $order->getPaddedId()]) }}</h1>

	<h3>{{ trans('account.transaction.title-shipping') }}</h3>
	@if($order->shipping_company != '')
		{{ $order->shipping_company }}<br/>
		c/o: {{ $order->shipping_name }}<br/>
	@else
		{{ $order->shipping_name }}<br/>
	@endif
	{{ $order->shipping_street }}<br/>
	{{ $order->shipping_city }}, {{ $order->shipping_zipcode }}<br/>
	{{ trans('countries.' . $order->shipping_country) }}<br/>

	<table class="table table--full text-left table--striped m-t-40 table--responsive table--responsive--wide">
		<thead>
		@if(count($order->lines) > 0)
			<tr>
				<th>{{ trans('account.transaction.table.headers.description') }}</th>
				<th>{{ trans('account.transaction.table.headers.amount') }}</th>
				<th>{{ trans('account.transaction.table.headers.taxes') }}</th>
				<th>{{ trans('account.transaction.table.headers.total') }}</th>
			</tr>
		@endif
		</thead>

		<tbody>
		@foreach($order->lines as $line)
			<tr>
				<td data-th="{{ trans('account.transaction.table.headers.description') }}">{{ trans("products.{$line->description}") }}</td>
				<td data-th="{{ trans('account.transaction.table.headers.amount') }}">{{ trans('general.money-fixed-currency', ['amount' => \App\Apricot\Libraries\MoneyLibrary::toMoneyFormat($line->amount, true), 'currency' => $order->currency]) }}</td>
				<td data-th="{{ trans('account.transaction.table.headers.taxes') }}">{{ trans('general.money-fixed-currency', ['amount' => \App\Apricot\Libraries\MoneyLibrary::toMoneyFormat($line->tax_amount, true), 'currency' => $order->currency]) }}</td>
				<td data-th="{{ trans('account.transaction.table.headers.total') }}"><strong>{{ trans('general.money-fixed-currency', ['amount' => \App\Apricot\Libraries\MoneyLibrary::toMoneyFormat($line->total_amount, true), 'currency' => $order->currency]) }}</strong></td>
			</tr>
		@endforeach
		</tbody>

		<tfoot>
		<tr>
			<td colspan="2" style="border: none;" class="hidden-xs"></td>
			<td style="border: none; text-align: right;" class="hidden-xs">{{ trans('account.transaction.table.totals.subtotal') }}</td>
			<td data-th="{{ trans('account.transaction.table.totals.subtotal') }}" style="border: none;">{{ trans('general.money-fixed-currency', ['amount' => \App\Apricot\Libraries\MoneyLibrary::toMoneyFormat($order->sub_total, true), 'currency' => $order->currency]) }}</td>
		</tr>

		<tr>
			<td colspan="2" style="border: none;" class="hidden-xs"></td>
			<td style="border: none; text-align: right;" class="hidden-xs">{{ trans('account.transaction.table.totals.shipping') }}</td>
			<td data-th="{{ trans('account.transaction.table.totals.shipping') }}" style="border: none;">{{ trans('general.money-fixed-currency', ['amount' => \App\Apricot\Libraries\MoneyLibrary::toMoneyFormat($order->total_shipping, true), 'currency' => $order->currency]) }}</td>
		</tr>

		<tr>
			<td colspan="2" style="border: none;" class="hidden-xs"></td>
			<td style="border: none; text-align: right;" class="hidden-xs">{{ trans('account.transaction.table.totals.taxes') }}</td>
			<td data-th="{{ trans('account.transaction.table.totals.taxes') }}" style="border: none;">{{ trans('general.money-fixed-currency', ['amount' => \App\Apricot\Libraries\MoneyLibrary::toMoneyFormat($order->total_taxes, true), 'currency' => $order->currency]) }}</td>
		</tr>

		<tr>
			<td colspan="2" style="border: none;" class="hidden-xs"></td>
			<td style="border: none; text-align: right; font-weight: bold;" class="hidden-xs">{{ trans('account.transaction.table.totals.total') }}</td>
			<td data-th="{{ trans('account.transaction.table.totals.total') }}" style="border: none; font-weight: bold;">{{ trans('general.money-fixed-currency', ['amount' => \App\Apricot\Libraries\MoneyLibrary::toMoneyFormat($order->total, true), 'currency' => $order->currency]) }}</td>
		</tr>
		</tfoot>
	</table>
@endsection