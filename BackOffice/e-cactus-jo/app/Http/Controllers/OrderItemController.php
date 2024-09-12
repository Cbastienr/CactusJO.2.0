<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OrderItemController extends Controller
{
    public function index()
    {
        $orderItems = OrderItem::all();
        return view('orderItems.index', compact('orderItems'));
    }

    public function show($id)
    {
        $orderItem = OrderItem::findOrFail($id);
        return view('orderItems.show', compact('orderItem'));
    }

    public function create()
    {
        return view('orderItems.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'sneaker_id' => 'required',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0', // Ajouter la validation du prix
        ]);

        // Vérifier que le sneaker existe via l'API
        $sneakerResponse = Http::get("http://54.37.12.181:1337/api/sneakers/{$request->sneaker_id}");
        if (!$sneakerResponse->successful()) {
            return back()->withErrors(['sneaker_id' => 'Sneaker not found via API']);
        }

        $sneakerData = $sneakerResponse->json()['data']['attributes'];
        OrderItem::create([
            'order_id' => $request->order_id,
            'sneaker_id' => $request->sneaker_id,
            'sneaker_name' => $sneakerData['name'],
            'quantity' => $request->quantity,
            'price' => $request->price,
        ]);

        return redirect()->route('orderItems.index');
    }

    public function edit($id)
    {
        $orderItem = OrderItem::findOrFail($id);
        return view('orderItems.edit', compact('orderItem'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0', // Ajouter la validation du prix
        ]);

        $orderItem = OrderItem::findOrFail($id);
        $orderItem->update($request->all());

        return redirect()->route('orderItems.index');
    }

    public function destroy($id)
    {
        $orderItem = OrderItem::findOrFail($id);
        $orderItem->delete();
        return redirect()->route('orderItems.index');
    }
}