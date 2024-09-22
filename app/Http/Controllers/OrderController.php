<?php

namespace App\Http\Controllers;

use App\Events\BillOfLadingReleased;
use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Return a listing of the orders with no Bill of Lading.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function unreleasedOrdersIndex(Request $request)
    {
        $unreleasedSelfContractedOrders = DB::table("orders")
            ->where("bl_release_date", '=', null)
            ->where('freight_payer_self', '=', false)
            ->get();

        return view('order.index', [
            'unreleasedSelfContractedOrders' => $unreleasedSelfContractedOrders,
        ]);
    }
    public function releaseBillOfLading(Order $order)
    {
        if($order->bl_release_date === null && $order->freight_payer_self === 0) {
            $order->bl_release_date = now();
            $order->bl_release_user_id = Auth::user()->id;
            $order->save();
            BillOfLadingReleased::dispatch($order);
            return redirect()->route('orders.unreleasedOrdersIndex')
                ->with('message', 'Go to release Bill of Lading successfully given,
                the consignee will receive a payment request for the freight invoice');
        } elseif ($order->bl_release_date !== null) {
            return redirect()->route('orders.unreleasedOrdersIndex')
                ->with('message', 'The Bill Of Lading for this order has already received a go for release');
        } elseif ($order->freight_payer_self === 1) {
            return redirect()->route('orders.unreleasedOrdersIndex')
                ->with('message', 'This order does not belong to a Hello Container contract');
        }
    }
}
