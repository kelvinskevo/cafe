<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">

            <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
                <div class="h-full max-w-full">
                    <header>
                        <h1 class="text-3xl font-medium text-gray-900">
                            {{ __('Upcoming events') }}
                        </h1>


                        <br>
                    </header>
                    <style>
                        .swiper-container {
                            width: 100%;
                            height: 100%;
                        }

                        .swiper-slide {
                            display: flex;
                            justify-content: center;
                            align-items: center;
                            text-align: center;
                            font-size: 18px;
                            background: #fff;
                        }

                        .swiper-slide img {
                            display: block;
                            width: 100%;
                            height: 40vh;
                            /* Set the height of the images */
                            object-fit: cover;
                        }

                        .event-card {
                            width: 100%;
                            margin: auto;
                        }

                        .event-card img {
                            height: 30vh;
                            /* Adjust the height of the images */
                        }
                    </style>

                    <swiper-container class="mySwiper" space-between="30" centered-slides="true" autoplay-delay="2500"
                        autoplay-disable-on-interaction="false">

                        @foreach ($events as $event)
                            <swiper-slide>
                                <div class="swiper-slide">
                                    <div class="overflow-hidden bg-white rounded-lg shadow-lg event-card">
                                        <img src="{{ asset('admin/event_images/' . $event->image) }}"
                                            alt="{{ $event->title }}">
                                        <div class="p-4">
                                            <h3 class="text-lg font-semibold text-gray-900">{{ $event->title }}</h3>
                                            <p class="text-gray-600">{{ $event->date }} | {{ $event->time }}</p>
                                            <p class="mt-2 text-gray-700"> {{ $event->description }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </swiper-slide>
                        @endforeach


                    </swiper-container>


                </div>
            </div>


            <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
                <div class="max-w-xl">
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Reservation Details') }}
                        </h2>
                    </header>
                    <br>
                    <div class="container px-4 mx-auto">
                        <div class="grid grid-cols-12 gap-4">
                            <div class="col-span-12">
                                <table id="reservations-table" class="min-w-full divide-y divide-gray-200">
                                    <thead class="text-white bg-gray-800">
                                        <tr>
                                            <th
                                                class="px-6 py-3 text-xs font-medium tracking-wider text-center uppercase">
                                                Guests</th>
                                            <th
                                                class="px-6 py-3 text-xs font-medium tracking-wider text-center uppercase">
                                                Date
                                            </th>
                                            <th
                                                class="px-6 py-3 text-xs font-medium tracking-wider text-center uppercase">
                                                Time
                                            </th>
                                            <th
                                                class="px-6 py-3 text-xs font-medium tracking-wider text-center uppercase">
                                                Status
                                            </th>
                                            <th
                                                class="px-6 py-3 text-xs font-medium tracking-wider text-center uppercase">
                                                Manage
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($currentReservations as $reservation)
                                            @php
                                                // Determine button class based on reservation status
                                                $buttonClass = '';
                                                if ($reservation->status == 'In Progress') {
                                                    $buttonClass = 'bg-blue-500 text-white';
                                                } elseif ($reservation->status == 'Rejected') {
                                                    $buttonClass = 'bg-red-500 text-white';
                                                } elseif ($reservation->status == 'Confirmed') {
                                                    $buttonClass = 'bg-green-500 text-white';
                                                } elseif ($reservation->status == 'Cancelled') {
                                                    $buttonClass = 'bg-black-500 text-white';
                                                }
                                            @endphp
                                            <tr>
                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    {{ $reservation->number_of_guests }}
                                                </td>
                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    {{ $reservation->date }}</td>
                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    {{ $reservation->time }}</td>
                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    <span class="px-4 py-2 rounded {{ $buttonClass }}">
                                                        {{ $reservation->status }}
                                                    </span>
                                                </td>
                                                <td class="px-4 py-2 text-center">
                                                    @if ($reservation->status == 'In Progress' || $reservation->status == 'Confirmed')
                                                        <button
                                                            onclick="openModal({{ $reservation->id }}, '{{ $reservation->number_of_guests }}', '{{ $reservation->date }}', '{{ $reservation->time }}', '{{ $reservation->status }}')"
                                                            class="px-4 py-2 text-white bg-yellow-500 rounded">Manage</button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
                <div class="max-w-xl">
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Previous Reservations') }}
                        </h2>
                    </header>
                    <br>
                    <div class="container px-4 mx-auto">
                        <div class="grid grid-cols-12 gap-4">
                            <div class="col-span-12">
                                <table id="reservations-table" class="min-w-full divide-y divide-gray-200">
                                    <thead class="text-white bg-gray-800">
                                        <tr>
                                            <th
                                                class="px-6 py-3 text-xs font-medium tracking-wider text-center uppercase">
                                                Guests</th>
                                            <th
                                                class="px-6 py-3 text-xs font-medium tracking-wider text-center uppercase">
                                                Date
                                            </th>
                                            <th
                                                class="px-6 py-3 text-xs font-medium tracking-wider text-center uppercase">
                                                Time
                                            </th>
                                            <th
                                                class="px-6 py-3 text-xs font-medium tracking-wider text-center uppercase">
                                                Status
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($previousReservations as $reservation)
                                            @php
                                                // Determine button class based on reservation status
                                                $buttonClass = '';
                                                if ($reservation->status == 'In Progress') {
                                                    $buttonClass = 'bg-blue-500 text-white';
                                                } elseif ($reservation->status == 'Rejected') {
                                                    $buttonClass = 'bg-red-500 text-white';
                                                } elseif ($reservation->status == 'Confirmed') {
                                                    $buttonClass = 'bg-green-500 text-white';
                                                } elseif ($reservation->status == 'Cancelled') {
                                                    $buttonClass = 'bg-yellow-500 text-white';
                                                }

                                            @endphp
                                            <tr>
                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    {{ $reservation->number_of_guests }}
                                                </td>
                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    {{ $reservation->date }}</td>
                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    {{ $reservation->time }}</td>
                                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                                    <span class="px-4 py-2 rounded {{ $buttonClass }}">
                                                        {{ $reservation->status }}
                                                    </span>
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
    </div>
    </div>
    </div>

    <!-- Modal -->
    <div id="modal" class="fixed inset-0 flex items-center justify-center hidden bg-black bg-opacity-50">
        <div class="w-2/3 p-6 bg-white rounded-lg shadow-lg">
            <h2 class="mb-4 text-xl">Manage Reservation</h2>
            <form id="update-form" method="POST">
                @csrf
                @method('PATCH')
                <div class="mb-4">
                    <label class="block text-gray-700">Number of Guests</label>
                    <input type="number" name="number_of_guests" id="number_of_guests"
                        class="w-full p-2 border rounded">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Date</label>
                    <input type="date" name="date" id="date" class="w-full p-2 border rounded">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Time</label>
                    <select name="time" id="time" class="w-full p-2 border rounded">
                        <option value="Breakfast">Breakfast</option>
                        <option value="Lunch">Lunch</option>
                        <option value="Dinner">Dinner</option>
                    </select>
                </div>
                <input type="hidden" name="id" id="reservation_id">
                <input type="hidden" name="status" value="In Progress"> <!-- Hidden field for status -->
                <div class="flex justify-end">
                    <button type="button" onclick="closeModal()"
                        class="px-4 py-2 mr-2 text-white bg-gray-500 rounded">Close</button>
                    <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded">Save</button>
                </div>
            </form>
            <form id="cancel-form" method="POST">
                @csrf
                @method('PATCH')
                <input type="hidden" name="id" id="cancel_reservation_id">
                <div class="flex justify-end mt-2">
                    <button type="submit" class="px-4 py-2 text-white bg-red-500 rounded">Cancel Reservation</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>

    <script>
        function openModal(id, numberOfGuests, date, time, status) {
            // Set values in the form
            document.getElementById('number_of_guests').value = numberOfGuests;
            document.getElementById('date').value = date;
            document.getElementById('time').value = time;
            document.getElementById('reservation_id').value = id;
            document.getElementById('cancel_reservation_id').value = id;

            // Set form actions
            document.getElementById('update-form').action = `/reservations/${id}`;
            document.getElementById('cancel-form').action = `/reservations/${id}/cancel`;

            // Show the modal
            document.getElementById('modal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('modal').classList.add('hidden');
        }
    </script>

    <!-- Include Swiper.js -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    {{-- <script>
        var swiper = new Swiper('#event-slider', {
            slidesPerView: 1,
            spaceBetween: 10,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    </script> --}}

</x-app-layout>
