@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <img src="{{ asset('storage/'.$product->featured_image) }}" alt="{{ $product->name }}" class="w-full h-64 object-cover">
        <div class="p-6">
            <h1 class="text-3xl font-bold">{{ $product->name }}</h1>
            <p class="text-gray-600 mt-2">Category: {{ $product->category->name ?? 'Uncategorized' }}</p>
            <p class="text-2xl font-bold text-green-600 mt-4">${{ number_format($product->price, 2) }}</p>
            <p class="mt-4">{{ $product->description }}</p>
            <p class="mt-2 text-sm text-gray-500">Stock: {{ $product->stock }}</p>

            <!-- Add to Cart Form -->
            <form action="{{ route('cart.add', $product) }}" method="POST" class="mt-6">
                @csrf
                <label for="quantity" class="mr-2">Quantity:</label>
                <input type="number" name="quantity" value="1" min="1" class="w-20 border px-2 py-1 rounded">
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded ml-2">Add to Cart</button>
            </form>
        </div>
    </div>
</div>
@endsection