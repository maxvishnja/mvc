@extends('layouts.account')

@section('pageClass', 'account account-settings account-settings-cancel')

@section('title', trans('account.settings_cancel.title'))

@section('content')
	<h1>{!! trans('account.settings_cancel.header') !!}</h1>

	<form action="{{ url()->action('AccountController@getSettingsSubscriptionCancel') }}" id="form" method="post">
		<label for="reason">{{ trans('account.settings_cancel.question') }}</label><br/>
		<div class="m-t-10 m-b-50">
			<select name="reason" class="select select--regular" id="reason">
				<option value="">{{ trans('account.settings_cancel.reasons.pick') }}</option>
				<option value="{{ trans('account.settings_cancel.reasons.0') }}">{{ trans('account.settings_cancel.reasons.0') }}</option>
				<option value="{{ trans('account.settings_cancel.reasons.1') }}">{{ trans('account.settings_cancel.reasons.1') }}</option>
				<option value="{{ trans('account.settings_cancel.reasons.2') }}">{{ trans('account.settings_cancel.reasons.2') }}</option>
				<option value="{{ trans('account.settings_cancel.reasons.3') }}">{{ trans('account.settings_cancel.reasons.3') }}</option>
				<option value="{{ trans('account.settings_cancel.reasons.4') }}">{{ trans('account.settings_cancel.reasons.4') }}</option>
				<option value="{{ trans('account.settings_cancel.reasons.5') }}">{{ trans('account.settings_cancel.reasons.5') }}</option>
				<option value="-1">{{ trans('account.settings_cancel.reasons.other') }}</option>
			</select>

			<div style="display: none;" id="other_reason" class="m-t-15 m-b-15">
				<label>{{ trans('account.settings_cancel.reason_text') }}</label><br/>
				<input type="text" name="other_reason" placeholder="{{ trans('account.settings_cancel.reason_text') }}" class="input input--regular input--full m-t-10">
			</div>

			<div style="display: none;" id="why_reason" class="m-t-15 m-b-15">
				<label>{{ trans('account.settings_cancel.why_reason_text') }}</label><br/>
				<input type="text" name="why_reason" placeholder="{{ trans('account.settings_cancel.why_reason_text') }}" class="input input--regular input--full m-t-10">
			</div>


			<div style="display: none;" id="other_firm" class="m-t-15 m-b-15">
				<label>{{ trans('account.settings_cancel.other_firm_text') }}</label><br/>
				<input type="text" name="other_firm" placeholder="{{ trans('account.settings_cancel.other_firm_text') }}" class="input input--regular input--full m-t-10">
			</div>

		</div>
		<a href="{{ url()->action('AccountController@getSettingsSubscription') }}" class="button button--green button--large">{{ trans('account.settings_cancel.cancel') }}</a>
		<button type="submit" class="button button--white button--text-green button--large">{{ trans('account.settings_cancel.submit') }}</button>

		{{csrf_field()}}
	</form>
@endsection

@section('footer_scripts')
	<script>


		$("#form").submit(function (e) {
		  var my_form = this;
			if($('#reason').val() === ''){
				swal({
					title: "{{ trans('account.settings_cancel.cancel_popup.title-error') }}",
					text: "{{ trans('account.settings_cancel.cancel_popup.text-error') }}",
					type: "error",
					html: true,
					confirmButtonText: "{{ trans('account.settings_subscription.cancel_popup.button-cancel-text') }}",
					confirmButtonColor: "#3AAC87",
					allowOutsideClick: true,
					showCancelButton: false,
					closeOnConfirm: false,
				});
				return false;
			}
			if($('#reason').val() === '-1'){
				if($('#other_reason input').val() === ''){
						swal({
						title: "{{ trans('account.settings_cancel.cancel_popup.title-error') }}",
						text: "{{ trans('account.settings_cancel.cancel_popup.text-error') }}",
						type: "error",
						html: true,
						confirmButtonText: "{{ trans('account.settings_subscription.cancel_popup.button-cancel-text') }}",
						confirmButtonColor: "#3AAC87",
						allowOutsideClick: true,
						showCancelButton: false,
						closeOnConfirm: false
					});
					return false;
				}
				return getConfirm(my_form, '{{ trans('account.settings_cancel.are_you_sure') }}');
			}

			if($('#reason').val() == '{{ trans('account.settings_cancel.reasons.5') }}'){
				if($('#why_reason input').val().length < 5){
					swal({
						title: "{{ trans('account.settings_cancel.cancel_popup.title-error') }}",
						text: "{{ trans('account.settings_cancel.cancel_popup.text-error') }}",
						type: "error",
						html: true,
						confirmButtonText: "{{ trans('account.settings_subscription.cancel_popup.button-cancel-text') }}",
						confirmButtonColor: "#3AAC87",
						allowOutsideClick: true,
						showCancelButton: false,
						closeOnConfirm: false
					});
					return false;
				}
				return getConfirm(my_form, '{{ trans('account.settings_cancel.are_you_sure') }}');
			}

			if($('#reason').val() == '{{ trans('account.settings_cancel.reasons.0') }}'){
				if($('#other_firm input').val().length < 5){
					swal({
						title: "{{ trans('account.settings_cancel.cancel_popup.title-error') }}",
						text: "{{ trans('account.settings_cancel.cancel_popup.text-error') }}",
						type: "error",
						html: true,
						confirmButtonText: "{{ trans('account.settings_subscription.cancel_popup.button-cancel-text') }}",
						confirmButtonColor: "#3AAC87",
						allowOutsideClick: true,
						showCancelButton: false,
						closeOnConfirm: false
					});
					return false;
				}
				return getConfirm(my_form, '{{ trans('account.settings_cancel.are_you_sure') }}');
			}
			return getConfirm(my_form, '{{ trans('account.settings_cancel.are_you_sure') }}');

		});


        function getConfirm (form, reason){
            swal({
                    title: reason,
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#3AAC87',
                    confirmButtonText: "{{ trans('account.settings_cancel.submit') }}",
                    cancelButtonText: "{{ trans('account.settings_subscription.snooze_popup.button-close-text') }}",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        form.submit();
                    } else {
                        swal.close() ;
                    }
                });
            return false;
        }


        $("#reason").change(function()
		{
			if( $(this).val() === '-1')
			{
				$("#other_reason").show();
			}
			else
			{
				$("#other_reason").hide();
			}

			if( $(this).val() == '{{ trans('account.settings_cancel.reasons.5') }}')
			{
				$("#why_reason").show();
			}
			else
			{
				$("#why_reason").hide();
			}

			if( $(this).val() == '{{ trans('account.settings_cancel.reasons.0') }}')
			{
				$("#other_firm").show();
			}
			else
			{
				$("#other_firm").hide();
			}
		});
	</script>
@endsection