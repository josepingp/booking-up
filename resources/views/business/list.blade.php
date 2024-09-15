<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Negocios') }}
        </h2>
    </x-slot>

    <div class="p-6 bg-white dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg m-2 mt-5">
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3 lm:grid-cols-4">
            @foreach ($businesses as $business)
                <div class="bg-white dark:bg-gray-700 overflow-hidden shadow-sm sm:rounded-lg font-semibold text-gray-600 dark:text-white mb-2 p-6">
                    <div class="text-gray-900 dark:text-gray-100">
                        <img src="{{ $business->image }}" alt="{{ $business->name }}"
                            class="w-full h-32 object-cover mb-4">
                        <h3 class="text-lg font-semibold mb-2">{{ $business->name }}</h3>
                        <p class="text-sm text-gray-600 dark:text-white mb-2">{{ $business->address }}</p>
                        <p class="text-sm text-gray-600 dark:text-white mb-2">{{ $business->phone }}</p>
                    </div>

                    <ul class="mt-4 space-y-2">
                        @foreach ($business->schedules as $schedule)
                            <li>
                                <span>{{ $schedule->dayOfWeekString }}:</span>
								@if(! $schedule->is_closed )
									{{ $schedule->open_time }} - {{ $schedule->close_time }}
								@else
									Cerrado
								@endif
                            </li>
                        @endforeach
                    </ul>

					<div class="mt-4 border-t border-gray-200 dark:border-gray-600 pt-4">
						<a href="{{route('slots.show', ['business' => $business, 'year' => now()->year, 'month' => now()->month, 'day' => now()->day]) }}"
						   class="text-blue-600 dark:text-blue-400 hover:underline">Ver disponibilidad</a>
					</div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
