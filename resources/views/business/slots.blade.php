<x-app-layout>
	<x-slot name="header">
		<h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
			{{ __('Slots disponibles de :business para :date', ['business' => $business->name,'date' => $date->isoFormat('dddd, D [de] YYYY')]) }}
		</h1>
	</x-slot>

	<div class="p-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg m-2 mt-5">
		<div class="flex items-center justify-around">
			@dateNotIsToday($date)
				@php $copy = $date->copy()->subDay(); @endphp
			<a href="{{route('slots.show', ['business' => $business, 'year' => $copy->year, 'month' => $copy->month, 'day' => $copy->day]) }}"
			   class="bg-blue-600 dark:bg-blue-500 text-white dark:text-gray-800 font-semibold py-2 px-4 rounded hover:bg-blue-500 dark:hover:bg-blue-300">
				Día anterior
			</a>
			@enddateNotIsToday

			<div class="text-center">
	<h2 class="text-lg text-white font-semibold mb-2">{{ $business->name }}</h2>
			</div>

			@dateWithinMaxFutureDays($date, $business)
				@php $copy = $date->copy()->addDay(); @endphp
				<a href="{{ route('slots.show', ['business' => $business, 'year' => $copy->year, 'month' => $copy->month, 'day' => $copy->day]) }}"
					class="bg-blue-600 dark:bg-blue-400 text-white dark:text-gray-900 font-semibold py-2 px-4 rounded hover:bg-blue-500 dark:hover:bg-blue-300">
					Día siguiente
				</a>
			@enddateWithinMaxFutureDays
		</div>
	</div>

</x-app-layout>
