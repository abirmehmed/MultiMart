@extends('layouts.admin')

@section('title', $product->name)

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.products.index') }}" 
       class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-900 font-medium transition">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
        Back to Products
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <!-- Images Section -->
    <div class="space-y-4">
        <!-- Main Image -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            @if($product->featured_image)
                <img src="{{ asset('storage/'.$product->featured_image) }}" 
                     alt="{{ $product->name }}" 
                     id="mainImage"
                     class="w-full h-96 object-cover">
            @else
                <div class="w-full h-96 bg-gray-200 flex items-center justify-center">
                    <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            @endif
        </div>

        <!-- Thumbnail Gallery -->
        @if($product->images->count() > 0)
        <div class="grid grid-cols-4 gap-4">
            @if($product->featured_image)
            <button onclick="changeImage('{{ asset('storage/'.$product->featured_image) }}')" 
                    class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition border-2 border-indigo-500">
                <img src="{{ asset('storage/'.$product->featured_image) }}" 
                     alt="Featured" 
                     class="w-full h-20 object-cover">
            </button>
            @endif
            
            @foreach($product->images as $image)
            <button onclick="changeImage('{{ asset('storage/'.$image->image_path) }}')" 
                    class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition border-2 border-transparent hover:border-indigo-500 relative group">
                <img src="{{ asset('storage/'.$image->image_path) }}" 
                     alt="Image {{ $loop->iteration }}" 
                     class="w-full h-20 object-cover">
                <form action="{{ route('admin.products.images.remove', $image) }}" 
                      method="POST" 
                      class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition"
                      onclick="event.stopPropagation(); if(confirm('Delete this image?')) this.submit();">
                    @csrf
                    @method('DELETE')
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                </form>
            </button>
            @endforeach
        </div>
        @endif
    </div>

    <!-- Product Details -->
    <div class="bg-white rounded-2xl shadow-lg p-8">
        <div class="flex items-start justify-between mb-4">
            <div>
                <span class="inline-block px-3 py-1 bg-indigo-100 text-indigo-800 text-xs font-semibold rounded-full mb-2">
                    {{ $product->category->name ?? 'Uncategorized' }}
                </span>
                <h1 class="text-3xl font-bold text-gray-900">{{ $product->name }}</h1>
            </div>
            @if($product->is_active)
                <span class="inline-flex items-center px-3 py-1 bg-green-100 text-green-800 text-sm font-semibold rounded-full">
                    <span class="w-2 h-2 bg-green-600 rounded-full mr-2"></span>
                    Active
                </span>
            @else
                <span class="inline-flex items-center px-3 py-1 bg-gray-100 text-gray-800 text-sm font-semibold rounded-full">
                    Inactive
                </span>
            @endif
        </div>

        <div class="space-y-6">
            <!-- Price -->
            <div class="flex items-baseline gap-2">
                <span class="text-4xl font-bold text-green-600">${{ number_format($product->price, 2) }}</span>
            </div>

            <!-- Stock -->
            <div class="flex items-center gap-2">
                @if($product->stock > 10)
                    <span class="inline-flex items-center text-green-700 font-medium">
                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        In Stock ({{ $product->stock }} units)
                    </span>
                @elseif($product->stock > 0)
                    <span class="inline-flex items-center text-yellow-700 font-medium">
                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                        Low Stock ({{ $product->stock }} units)
                    </span>
                @else
                    <span class="inline-flex items-center text-red-700 font-medium">
                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Out of Stock
                    </span>
                @endif
            </div>

            <!-- Description -->
            <div>
                <h3 class="text-sm font-semibold text-gray-700 uppercase tracking-wide mb-2">Description</h3>
                <p class="text-gray-700 leading-relaxed">{{ $product->description }}</p>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-2 gap-4 pt-6 border-t border-gray-200">
                <div>
                    <p class="text-sm text-gray-500">Created</p>
                    <p class="font-medium text-gray-900">{{ $product->created_at->format('M d, Y') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Last Updated</p>
                    <p class="font-medium text-gray-900">{{ $product->updated_at->format('M d, Y') }}</p>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex gap-3 pt-4">
                <a href="{{ route('admin.products.edit', $product) }}" 
                   class="flex-1 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transition text-center">
                    Edit Product
                </a>
                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            onclick="return confirm('Are you sure you want to delete this product?')"
                            class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transition">
                        Delete Product
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function changeImage(src) {
    const mainImage = document.getElementById('mainImage');
    mainImage.style.opacity = '0';
    setTimeout(() => {
        mainImage.src = src;
        mainImage.style.opacity = '1';
    }, 200);
}
</script>
@endsection