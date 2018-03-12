@extends('layouts.account')

@section('pageClass', 'account account-settings account-settings-basic')

@section('title', trans('account.settings_discount.title'))

@section('content')

    <h2>{{ trans('account.settings_discount.title') }}</h2>

    <div class="m-t-30 m-b-50">

         <h1>{{ trans('account.settings_discount.text1') }} = {{$coupon}}</h1>

        <br>

        <p style="font-size: 1.8em">
             {!! trans('account.settings_discount.body') !!}
        </p>
        <br>
        <p style="font-size: 1.8em">

            {!! str_replace('{count}', $count, nl2br(trans('account.settings_discount.count_free'))) !!}

        </p>
    </div>
@endsection