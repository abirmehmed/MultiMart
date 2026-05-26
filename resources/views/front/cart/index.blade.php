@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4">
    <h1 class="text-2xl font-bold mb-6">Shopping Cart</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    @if(!empty($cart))
        <table class="w-full border-collapse">
            <thead>
                <tr><th class="border p-2">Product</th><th class="border p-2">Qty</th><th class="border p-2">Price</th><th class="border p-2">Total</th><th class="border p-2">Action</th></tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach($cart as $id => $item)
                    @php $subtotal = $item['quantity'] * $item['price']; $total += $subtotal; @endphp
                    <tr>
                        <td class="border p-2">{{ $item['name'] }}</td>
                        <td class="border p-2">
                            <form action="{{ route('cart.update', $id) }}" method="POST" class="inline">
                                @csrf @method('PATCH')
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="w-16">
                                <button type="submit" class="bg-blue-500 text-white px-2 py-1 rounded">Update</button>
                            </form>
                        </td>
                        <td class="border p-2">${{ number_format($item['price'], 2) }}</td>
                        <td class="border p-2">${{ number_format($subtotal, 2) }}</td>
                        <td class="border p-2">
                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button class="bg-red-500 text-white px-2 py-1 rounded">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                <tr><td colspan="3" class="text-right font-bold p-2">Total:</td><td class="font-bold p-2">${{ number_format($total, 2) }}</td><td></td></tr>
            </tbody>
        </table>
        <div class="mt-4">
            <a href="{{ route('products.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Continue Shopping</a>
            <a href="#" class="bg-green-600 text-white px-4 py-2 rounded ml-2">Proceed to Checkout</a>
        </div>
    @else
        <p>Your cart is empty. <a href="{{ route('products.index') }}" class="text-blue-500">Shop now</a></p>
    @endif
</div>
@endsection