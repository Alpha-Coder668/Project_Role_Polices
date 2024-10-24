<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Product Name -->
                        <div class="mb-4">
                            <label for="name" class="form-label">Product Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="text-red-600 mt-2 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Price -->
                        <div class="mb-4">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" name="price" class="form-control" value="{{ old('price') }}" required>
                            @error('price')
                                <div class="text-red-600 mt-2 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="text-red-600 mt-2 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div class="mb-4">
                            <label for="category_id" class="form-label">Category</label>
                            <select name="category_id" class="form-control" required>
                                <option value="">Select a category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="text-red-600 mt-2 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Product Images -->
                        <div class="mb-4">
                            <label for="images" class="form-label">Product Images</label>
                            <input type="file" name="images[]" class="form-control" multiple required>
                            @error('images')
                                <div class="text-red-600 mt-2 text-sm">{{ $message }}</div>
                            @enderror
                            @error('images.*')
                                <div class="text-red-600 mt-2 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Create Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
