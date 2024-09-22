<?php

namespace App\Http\Controllers\Test;

use App\Events\BillOfLadingReleased;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class TestOrderController extends Controller
{
    /**
     * Release the bill of lading for the given order.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function testReleaseBillOfLading(Order $order)
    {
        if($order->bl_release_date === null && $order->freight_payer_self === 0) {
            $order->bl_release_date = now();
            $order->bl_release_user_id = Auth::user()->id;
            BillOfLadingReleased::dispatch($order);
            dd( 'Go to release Bill of Lading successfully given,
                the consignee will receive a payment request for the freight invoice');
        } elseif ($order->bl_release_date !== null) {
            dd('The Bill Of Lading for this order has already received a go for release');
        } elseif ($order->freight_payer_self === 1) {
                dd('This order does not belong to a Hello Container contract');
        }
    }
}
