<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="name" class="form-label">Product Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" name="price" class="form-control" value="{{ $product->price }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" class="form-control">{{ $product->description }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label for="images" class="form-label">Update Product Images</label>
                            <input type="file" name="images[]" class="form-control" multiple>
                        </div>

                        <button type="submit" class="btn btn-warning">Update Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
