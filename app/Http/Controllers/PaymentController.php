<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use App\Models\PaymentLink;

class PaymentController extends Controller
{
    public function pay(Request $request, $paymentLinkId)
    {
        $paymentLink = PaymentLink::findOrFail($paymentLinkId);

        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));

            $charge = Charge::create([
                'amount' => $paymentLink->amount_due * 100, // Convert to cents
                'currency' => 'usd',
                'source' => $request->stripeToken,
                'description' => 'Rent payment for ' . $paymentLink->rental->property_name,
            ]);

            $paymentLink->update(['status' => 'paid']);
            return redirect()->route('payment-links.show', $paymentLink->id)->with('success', 'Payment successful!');
        } catch (\Exception $e) {
            return back()->with('error', 'Payment failed: ' . $e->getMessage());
        }
    }
}
