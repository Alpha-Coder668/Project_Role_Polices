<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight">
            {{ __('All Products') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-800">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex">
            <!-- Sidebar for Categories -->
            <div class="w-1/4 mr-4 bg-gray-700 rounded-lg p-4 shadow-md">
                <h3 class="font-semibold text-lg text-white mb-4">Categories</h3>
                <ul class="space-y-2">
                    @foreach($categories as $category)
                        <li>
                            <a href="{{ route('categories.show', $category->id) }}" class="block p-2 bg-gray-600 rounded hover:bg-gray-500 transition">
                                {{ $category->name }}
                                <span class="text-gray-300 text-sm">({{ $category->products_count }})</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Main Products Section -->
            <div class="flex-1 bg-gray-800 shadow-lg rounded-lg overflow-hidden">
                <div class="p-6 bg-gray-700 border-b border-gray-600">
                    <h3 class="text-2xl font-semibold text-white mb-4">Available Products</h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @forelse($products as $product)
                            <div class="bg-gray-600 rounded-lg shadow-md overflow-hidden transition transform hover:scale-105">
                                <div class="h-48 bg-gray-500">
                                    @if($product->images)
                                        @php
                                            $images = json_decode($product->images);
                                        @endphp
                                        <img src="{{ asset('storage/' . $images[0]) }}" class="object-cover w-full h-full" alt="{{ $product->name }}" />
                                    @else
                                        <p class="text-center text-gray-300 h-full flex items-center justify-center">No image available</p>
                                    @endif
                                </div>
                                <div class="p-4">
                                    <h4 class="font-semibold text-lg text-white">{{ $product->name }}</h4>
                                    <p class="text-gray-300">{{ Str::limit($product->description, 50) }}</p>
                                    <div class="flex justify-between items-center mt-2">
                                        <span class="font-bold text-green-400">${{ number_format($product->price, 2) }}</span>
                                        <a href="{{ route('products.show', $product->id) }}" class="text-blue-400 hover:text-green-400 transition">
                                            <i class="fas fa-eye fa-lg"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-4 text-center text-gray-300">
                                No products available at the moment.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Improved Hover Effect JavaScript (optional) --}}
    <script>
        // Optional hover effects can be added if needed
    </script>
</x-app-layout>
