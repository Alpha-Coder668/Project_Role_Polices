{{-- resources/views/products/show.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-2xl font-bold mb-4">{{ $product->name }}</h3>

                    <p><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
                    <p><strong>Description:</strong> {{ $product->description }}</p>
                  

                    @if($product->images)
                        <h4 class="font-semibold text-lg mt-4">Product Images</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
                            @foreach(json_decode($product->images) as $image)
                                <div class="h-64 overflow-hidden rounded-lg shadow-md">
                                    <img src="{{ asset('storage/' . $image) }}" class="object-cover w-full h-full" alt="{{ $product->name }}">
                                </div>
                            @endforeach
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
