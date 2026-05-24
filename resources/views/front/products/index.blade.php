@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">All Products</h1>

    <div class="mb-6">
        <a href="{{ route('products.index') }}" class="bg-gray-200 px-3 py-1 rounded">All</a>
        @foreach($categories as $cat)
            <a href="{{ route('category.products', $cat->slug) }}" class="bg-gray-200 px-3 py-1 rounded ml-2">{{ $cat->name }}</a>
        @endforeach
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse($products as $product)
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <img src="{{ asset('storage/'.$product->featured_image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="font-bold text-lg">{{ $product->name }}</h3>
                    <p class="text-gray-600">${{ number_format($product->price, 2) }}</p>
                    <a href="{{ route('products.show', $product->slug) }}" class="mt-2 inline-block bg-blue-500 text-white px-4 py-1 rounded">View</a>
                </div>
            </div>
        @empty
            <p>No products found.</p>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $products->links() }}
    </div>
</div>
@endsection
