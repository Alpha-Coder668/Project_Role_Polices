<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Questions for ') . $product->name }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="p-6">
                    <h4 class="text-2xl font-semibold mb-4">Questions</h4>

                    @if (session('success'))
                        <div id="success-alert" class="bg-green-500 text-white p-3 rounded-md mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('products.storeQuestion', $product->id) }}" method="POST" class="mb-4">
                        @csrf
                        <div class="form-group">
                            <label for="question" class="block text-sm font-medium text-gray-700">Ask a Question:</label>
                            <input type="text" name="question" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-500" required>
                        </div>
                        <button type="submit" class="mt-2 bg-blue-500 text-white hover:bg-blue-600 font-semibold py-2 px-4 rounded transition duration-200">Submit</button>
                    </form>

                    <ul class="list-group">
    @foreach ($product->questions as $question)
        <li class="list-group-item border-b border-gray-200 py-4">
            <strong>Q:</strong> {{ $question->question }}<br>

            @if ($question->answers->isNotEmpty())
                @foreach ($question->answers as $answer)
                    <div class="ml-4 mt-2">
                        <strong class="text-green-600">A:</strong> {{ $answer->answer }}
                    </div>
                @endforeach
            @else
                <div class="ml-4 mt-2 text-gray-500 italic">
                    No answers yet.
                </div>
            @endif

            <a href="{{ route('questions.answers', $question->id) }}" class="text-blue-500 hover:underline">View Answers</a>

            <form action="{{ route('questions.destroy', $question->id) }}" method="POST" class="mt-2">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white hover:bg-red-600 font-semibold py-2 px-4 rounded transition duration-200">Delete Question</button>
            </form>
        </li>
    @endforeach
</ul>

                </div>
            </div>
        </div>
    </div>

    <script>
        // JavaScript to remove the alert after 2 seconds
        document.addEventListener('DOMContentLoaded', function () {
            const alertBox = document.getElementById('success-alert');
            if (alertBox) {
                setTimeout(function () {
                    alertBox.style.display = 'none';
                }, 2000); // 2 seconds
            }
        });
    </script>
</x-app-layout>
