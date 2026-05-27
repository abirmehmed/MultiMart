@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white rounded-lg shadow overflow-hidden">
        {{-- Product Image --}}
        @if($product->featured_image)
            <img src="{{ asset('storage/'.$product->featured_image) }}" alt="{{ $product->name }}" class="w-full h-64 object-cover">
        @else
            <img src="{{ asset('storage/placeholder.jpg') }}" alt="{{ $product->name }}" class="w-full h-64 object-cover">
        @endif
        
        <div class="p-6">
            {{-- Product Name --}}
            <h1 class="text-3xl font-bold text-gray-900">{{ $product->name }}</h1>
            
            {{-- Category --}}
            <p class="text-gray-600 mt-2">
                Category: {{ $product->category->name ?? 'Uncategorized' }}
            </p>
            
            {{-- Price --}}
            <p class="text-2xl font-bold text-green-600 mt-4">
                ${{ number_format($product->price, 2) }}
            </p>
            
            {{-- Description --}}
            <p class="mt-4 text-gray-700">{{ $product->description }}</p>
            
            {{-- Stock --}}
            <p class="mt-2 text-sm text-gray-500">
                Stock: {{ $product->stock > 0 ? $product->stock . ' available' : 'Out of stock' }}
            </p>

            {{-- Add to Cart Form --}}
            @if($product->stock > 0)
                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-6">
                    @csrf
                    <div class="flex items-center flex-wrap gap-4">
                        <label for="quantity" class="font-medium text-gray-700">Quantity:</label>
                        <input 
                            type="number" 
                            name="quantity" 
                            id="quantity"
                            value="1" 
                            min="1" 
                            max="{{ $product->stock }}"
                            class="w-20 border border-gray-300 px-3 py-2 rounded"
                        >
                        <button 
                            type="submit" 
                            style="background-color: #22c55e !important; color: white !important; padding: 10px 24px !important; font-weight: 600 !important; border-radius: 6px !important;"
                            class="bg-green-500 text-white px-6 py-2 rounded ml-2"
                        >
                            🛒 Add to Cart
                        </button>
                    </div>
                </form>
            @else
                <p class="mt-4 text-red-500 font-medium">❌ Out of Stock</p>
            @endif
        </div>
    </div>
</div>

{{-- Success Message --}}
@if(session('success'))
    <div class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded shadow z-50">
        {{ session('success') }}
        <a href="{{ route('cart.index') }}" class="underline ml-2">View Cart →</a>
    </div>
@endif
@endsection