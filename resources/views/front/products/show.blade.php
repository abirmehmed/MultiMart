@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-white to-gray-100 py-12">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Back Button --}}
        <a href="{{ url()->previous() }}" class="inline-flex items-center text-gray-600 hover:text-indigo-600 mb-6 font-medium transition">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Products
        </a>

        {{-- Product Card --}}
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="md:flex">
                {{-- Product Image --}}
                <div class="md:w-1/2 bg-gradient-to-br from-gray-100 to-gray-200">
                    @if($product->featured_image)
                        <img src="{{ asset('storage/'.$product->featured_image) }}" 
                             alt="{{ $product->name }}" 
                             class="w-full h-96 object-cover">
                    @else
                        <img src="{{ asset('storage/placeholder.jpg') }}" 
                             alt="{{ $product->name }}" 
                             class="w-full h-96 object-cover">
                    @endif
                </div>

                {{-- Product Details --}}
                <div class="md:w-1/2 p-8">
                    {{-- Category Badge --}}
                    <span class="inline-block bg-indigo-100 text-indigo-800 text-xs font-semibold px-3 py-1 rounded-full mb-4">
                        {{ $product->category->name ?? 'Uncategorized' }}
                    </span>

                    {{-- Product Name --}}
                    <h1 class="text-3xl font-bold text-gray-900 mb-4">
                        {{ $product->name }}
                    </h1>

                    {{-- Price --}}
                    <p class="text-4xl font-extrabold text-green-600 mb-6">
                        ${{ number_format($product->price, 2) }}
                    </p>

                    {{-- Description --}}
                    <p class="text-gray-700 mb-6 leading-relaxed">
                        {{ $product->description }}
                    </p>

                    {{-- Stock Status --}}
                    <div class="mb-8">
                        @if($product->stock > 0)
                            <span class="inline-flex items-center text-green-600 font-semibold">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                In Stock ({{ $product->stock }} available)
                            </span>
                        @else
                            <span class="inline-flex items-center text-red-600 font-semibold">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Out of Stock
                            </span>
                        @endif
                    </div>

                    {{-- Add to Cart Form --}}
                    @if($product->stock > 0)
                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf
                            <div class="flex items-center gap-4 mb-6">
                                <label for="quantity" class="font-medium text-gray-700">Quantity:</label>
                                <input type="number" 
                                       name="quantity" 
                                       id="quantity"
                                       value="1" 
                                       min="1" 
                                       max="{{ $product->stock }}"
                                       class="w-20 border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            </div>
                            
                            <button type="submit" 
                                    style="background: linear-gradient(135deg, #22c55e, #16a34a) !important;"
                                    class="w-full bg-green-500 hover:bg-green-600 text-white font-semibold py-4 px-6 rounded-xl transition transform hover:scale-[1.02] shadow-lg hover:shadow-xl flex items-center justify-center gap-2">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-1.829.129-1.829-.776V17a2 2 0 002 2h10a2 2 0 002-2v-2.293l-2.293-2.293M9 17a2 2 0 01-2-2v-2.293l2.293 2.293z"></path>
                                </svg>
                                Add to Cart
                            </button>
                        </form>
                    @else
                        <button disabled 
                                class="w-full bg-gray-300 text-gray-500 font-semibold py-4 px-6 rounded-xl cursor-not-allowed flex items-center justify-center gap-2">
                            ❌ Currently Unavailable
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Success Message --}}
@if(session('success'))
    <div id="flash-message" class="fixed top-4 right-4 bg-gradient-to-r from-green-500 to-emerald-600 text-white px-6 py-4 rounded-xl shadow-2xl z-50 flex items-center gap-3">
        <span class="text-2xl">✅</span>
        <div>
            <p class="font-semibold">Added to Cart!</p>
            <p class="text-sm">{{ session('success') }}</p>
        </div>
        <a href="{{ route('cart.index') }}" class="ml-4 underline font-semibold">View Cart →</a>
        <button onclick="document.getElementById('flash-message').remove()" class="ml-2 text-white/80 hover:text-white">&times;</button>
    </div>
    <script>
        setTimeout(() => {
            const msg = document.getElementById('flash-message');
            if (msg) {
                msg.style.transition = 'opacity 0.5s';
                msg.style.opacity = '0';
                setTimeout(() => msg.remove(), 500);
            }
        }, 5000);
    </script>
@endif
@endsection