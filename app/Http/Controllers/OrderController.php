<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        // Aquí puedes obtener los pedidos de la base de datos
        $orders = Order::orderBy('created_at', 'desc')->paginate(10);

        // Retornar la vista con los pedidos
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $clients = Client::all();
        return view('orders.create', compact('clients'));
    }

    public function store(Request $request)
    {
        Order::create([
            'client_id' => $request->client_id,
            'salesperson_id' => auth()->id(),
            'invoice_number' => $request->invoice_number,
            'status' => 'Ordered',
            'notes' => $request->notes,
        ]);

        return redirect()->route('orders.index');
    }

    public function updateStatus(Order $order, Request $request)
    {
        $order->update(['status' => $request->status]);
        
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('photos');
            if ($order->status == 'In route') {
                $order->route_photo = $path;
            } elseif ($order->status == 'Delivered') {
                $order->delivery_photo = $path;
            }
            $order->save();
        }

        return redirect()->route('orders.show', $order);
    }
}
