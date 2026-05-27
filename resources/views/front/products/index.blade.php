@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900">All Products</h1>
        
        {{-- Cart Link --}}
        <a href="{{ route('cart.index') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded font-semibold">
            🛒 Cart
        </a>
    </div>

    {{-- Category Filters --}}
    <div class="mb-6 flex flex-wrap gap-2">
        <a href="{{ route('products.index') }}" class="px-4 py-2 rounded bg-gray-200 hover:bg-gray-300">All</a>
        @foreach($categories as $cat)
            <a href="{{ route('category.products', $cat->slug) }}" class="px-4 py-2 rounded bg-gray-200 hover:bg-gray-300">
                {{ $cat->name }}
            </a>
        @endforeach
    </div>

    {{-- Products Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse($products as $product)
            {{-- Clickable Card --}}
            <div class="bg-white rounded-lg shadow overflow-hidden hover:shadow-lg transition cursor-pointer" 
                 onclick="window.location.href='{{ route('products.show', $product->slug) }}'">
                <img src="{{ asset('storage/'.$product->featured_image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="font-bold text-lg">{{ $product->name }}</h3>
                    <p class="text-gray-600">${{ number_format($product->price, 2) }}</p>
                    <button class="mt-3 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded text-sm">
                        View Details →
                    </button>
                </div>
            </div>
        @empty
            <p class="col-span-full text-center text-gray-500">No products found.</p>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="mt-6">
        {{ $products->links() }}
    </div>
</div>
@endsection