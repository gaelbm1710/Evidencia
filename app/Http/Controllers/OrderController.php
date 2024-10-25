<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $query = Order::query();

        if ($request->filled('invoice_number')) {
            $query->where('invoice_number', $request->invoice_number);
        }

        if ($request->filled('customer_number')) {
            $query->whereHas('customer', function ($q) use ($request) {
                $q->where('customer_number', $request->customer_number);
            });
        }

        if ($request->filled('date')) {
            $query->whereDate('order_date', $request->date);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->orderBy('created_at', 'desc')->get();

        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        return view('orders.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'invoice_number' => 'required|unique:orders,invoice_number',
            'customer_name' => 'nullable|string',
            'company_name' => 'nullable|string',
            'customer_number' => 'required|unique:customers,customer_number',
            'fiscal_data' => 'required|string',
            'delivery_address' => 'required|string',
            'notes' => 'nullable|string',
            'order_date' => 'required|date',
        ]);

        $customer = Customer::create([
            'name' => $request->customer_name,
            'company_name' => $request->company_name,
            'customer_number' => $request->customer_number,
            'fiscal_data' => $request->fiscal_data,
            'delivery_address' => $request->delivery_address,
        ]);

        $invoice = Invoice::create([
            'invoice_number' => $request->invoice_number,
            'fiscal_data' => $request->fiscal_data,
            'customer_id' => $customer->id,
        ]);

        Order::create([
            'invoice_number' => $invoice->invoice_number,
            'customer_id' => $customer->id,
            'order_date' => $request->order_date,
            'delivery_address' => $request->delivery_address,
            'notes' => $request->notes,
            'status' => 'Ordered',
        ]);

        return redirect()->route('orders.index')->with('success', 'Orden creada exitosamente.');
    }

    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        return view('orders.edit', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'delivery_address' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $order->delivery_address = $request->delivery_address;
        $order->notes = $request->notes;
        $order->save();

        return redirect()->route('orders.index')->with('success', 'Orden actualizada exitosamente.');
    }

    public function changeStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:Ordered,In process,In route,Delivered',
            'photo_route' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'photo_delivery' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $order->status = $request->status;

        if ($request->hasFile('photo_route')) {
            $path = $request->file('photo_route')->store('photos_route', 'public');
            $order->photo_route = $path;
        }

        if ($request->hasFile('photo_delivery')) {
            $path = $request->file('photo_delivery')->store('photos_delivery', 'public');
            $order->photo_delivery = $path;
        }

        $order->save();

        return redirect()->route('orders.index')->with('success', 'Estado de la orden actualizado.');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Orden eliminada exitosamente.');
    }

    public function archived()
    {
        $orders = Order::onlyTrashed()->get();
        return view('orders.archived', compact('orders'));
    }

    public function restore($id)
    {
        $order = Order::onlyTrashed()->findOrFail($id);
        $order->restore();
        return redirect()->route('orders.archived')->with('success', 'Orden restaurada exitosamente.');
    }
}
