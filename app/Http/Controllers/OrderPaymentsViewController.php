<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderPaymentsView;
use Illuminate\Http\Request;

class OrderPaymentsViewController extends Controller
{
    public function viewIndex()
    {
        $orderPayments = OrderPaymentsView::all();

        return view('pending.payments.paymentsTable', compact('orderPayments'));
    }
}
