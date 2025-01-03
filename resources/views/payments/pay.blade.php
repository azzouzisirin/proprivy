@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Pay Rent</h2>
    <form action="{{ route('payments.pay', $paymentLink->id) }}" method="POST">
        @csrf
        <input type="hidden" name="paymentLinkId" value="{{ $paymentLink->id }}">
        <script
            src="https://checkout.stripe.com/checkout.js"
            class="stripe-button"
            data-key="{{ env('STRIPE_KEY') }}"
            data-amount="{{ $paymentLink->amount_due * 100 }}"
            data-name="ProPrivy Rent Payment"
            data-description="Payment for {{ $paymentLink->rental->property_name }}"
            data-image="https://your-logo-url.com"
            data-currency="usd">
        </script>
    </form>
</div>
@endsection
