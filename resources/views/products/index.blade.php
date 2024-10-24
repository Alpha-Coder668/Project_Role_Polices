<x-app-layout>
    <x-slot name="header">
        <h1 class="text-center mb-4 font-weight-bold text-primary">Manage Products</h1>
    </x-slot>

    <div class="container my-5">
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('products.create') }}" class="btn btn-primary btn-lg shadow-sm">
                <i class="fas fa-plus"></i> Add New Product
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success" id="success-alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive shadow-sm rounded">
            <table class="table table-striped table-hover table-bordered rounded">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th> <!-- For custom numbering -->
                        <th>Name</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $index => $product) <!-- Custom numbering using $index -->
                        <tr>
                            <td>{{ $index + 1 }}</td> <!-- Display index starting from 1 -->
                            <td>
                                <a href="{{ route('products.show', $product->id) }}" class="text-primary font-weight-bold">
                                    {{ $product->name }}
                                </a>
                            </td>
                            <td>${{ number_format($product->price, 2) }}</td>
                            <td>{{ $product->category->name ?? 'N/A' }}</td>
                            <td class="text-center">
                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-success btn-sm mr-2">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm mr-2">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Are you sure you want to delete this product?');">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No products found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
     

    <style>
        /* Your CSS styles here */
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                var successAlert = document.getElementById('success-alert');
                if (successAlert) {
                    successAlert.style.display = 'none';
                }
            }, 2000); // 2 seconds
        });
    </script>
</x-app-layout>
