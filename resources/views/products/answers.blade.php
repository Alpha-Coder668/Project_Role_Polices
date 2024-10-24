<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Answers for Question') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="p-6">
                    <h3 class="text-3xl font-bold text-gray-800 mb-2">{{ $question->product->name }}</h3>
                    <p class="text-lg text-gray-700 mb-4"><strong>Question:</strong> {{ $question->question }}</p>

                    <h4 class="text-2xl font-semibold mb-4">Answers</h4>

                    <ul class="list-group">
                        @foreach ($question->answers as $answer)
                            <li class="list-group-item border-b border-gray-200 py-4">
                                <strong>A:</strong> {{ $answer->answer }}
                                <form action="{{ route('answers.destroy', $answer->id) }}" method="POST" class="mt-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white hover:bg-red-600 font-semibold py-2 px-4 rounded transition duration-200">Delete Answer</button>
                                </form>
                            </li>
                        @endforeach
                    </ul>

                    <form action="{{ route('questions.answer', $question->id) }}" method="POST" class="mt-4">
                        @csrf
                        <input type="text" name="answer" placeholder="Type your answer here" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-500" required>
                        <button type="submit" class="mt-2 bg-green-500 text-white hover:bg-green-600 font-semibold py-2 px-4 rounded transition duration-200">Submit Answer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
