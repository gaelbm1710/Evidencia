<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class PublicController extends Controller
{
    public function home()
    {
        return view('public.home');
    }

    public function search(Request $request)
    {
        $request->validate([
            'customer_number' => 'nullable|string',
            'invoice_number' => 'nullable|string',
        ]);

        $order = Order::where('invoice_number', $request->invoice_number)
            ->whereHas('customer', function ($q) use ($request) {
                if ($request->customer_number) {
                    $q->where('customer_number', $request->customer_number);
                }
            })->first();

        if ($order) {
            return view('public.result', compact('order'));
        }

        return redirect()->back()->with('error', 'Orden no encontrada.');
    }
}
