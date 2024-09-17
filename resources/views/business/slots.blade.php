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

	@if($business->slots->isEmpty())
		<div class="p-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg m-2">
			<p class="bg-red-500 text-white p-4 rounded-md">
				No hay horarios disponibles para este día.
			</p>
		</div>
	@endif


	<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-6 p-2 text-center gap-4">
		@foreach($business->slots as $slot)
			<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
				<div class="p-6 text-gray-900 dark:text-gray-100">
					<p class="text-sm text-gray-600 dark:text-gray-400">
						{{ $slot->start_time }} - {{ $slot->end_time }}
					</p>

					<p class="text-sm text-gray-600 dark:text-gray-400 {{ $slot->isBooked() ? 'text-red-600 dark:text-red-400' : 'text-green-600 dark:text-green-400' }}" >
						@if($slot->isBooked())
							@if($slot->isMyBooking())

								Reservado por mi

							@else

								Reservado

							@endif
						@else

							Disponible

						@endif
					</p>
				</div>

				@if($slot->canBeBooked())
					<div class="mb-6 bg-white dark:bg-gray-800">
						@if(auth()->user()->hasCredits())
							<form action="{{ route('slots.book', ['business' => $business, 'slot' => $slot]) }}" method="post">
								@csrf
								<button class="bg-green-600 dark:bg-green-400 text-white dark:text-gray-900 font-semibold py-2 px-4
								rounded hover:bg-green-500 dark:hover:bg-green-300">
									Reservar
								</button>
							</form>
						@else
							<button class="bg-gray-600 dark:bg-gray-400 text-white dark:text-gray-900 font-semibold py-2 px-4 rounded cursor-not-allowed" disabled>
								Sin créditos
							</button>
						@endif
					</div>
				@else
					<div class="mb-6 bg-white dark:bg-gray-800">
					<button class="bg-gray-600 dark:bg-gray-400 text-white dark:text-gray-900 font-semibold py-2 px-4 rounded cursor-not-allowed" disabled>
						No disponible
					</button>
					</div>
				@endif

				@if($slot->isMyBooking())
					<div class="mb-6 bg-white dark:bg-gray-800">

						@if($slot->canCancelBook())

							<form action=" {{route('bookings.cancel', ['business' => $business, 'booking' => $slot->booking])}}" method="post">
								@csrf
								<button
									type="submit"
									class="bg-red-600 dark:border-r-red-400 text-white dark:text-gray-900 font-semibold py-2 px-4 rounded hover:bg-red-500 dark:hover:bg-red-300"
									>
									Cancelar
								</button>
							</form>

						@else
							<button class="bg-gray-600 dark:bg-gray-400 text-white dark:text-gray-900 font-semibold py-2 px-4 rounded cursor-not-allowed" disabled>
								No se puede cancelar
							</button>
						@endif

					</div>
				@endif

			</div>
		@endforeach
	</div>
</x-app-layout>
