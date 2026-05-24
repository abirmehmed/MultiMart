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
            <a href="#" class="mt-6 inline-block bg-blue-500 text-white px-6 py-2 rounded">Add to Cart</a>
        </div>
    </div>
</div>
@endsection
