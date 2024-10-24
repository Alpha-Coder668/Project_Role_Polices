<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-4xl text-gray-900 leading-tight">
            {{ __('Reported Reviews') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @foreach ($reportedReviews as $report)
                <div class="bg-white shadow-xl rounded-lg p-6 mb-4">
                    <h3 class="text-2xl font-bold">{{ $report->review->user->name }}'s Review</h3>
                    <p class="text-gray-800">{{ $report->review->review }}</p>
                    <p class="text-red-500">Reason: {{ $report->reason }}</p>
                    <p class="text-gray-500 text-sm">{{ $report->created_at->diffForHumans() }}</p>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
