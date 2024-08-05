@extends('admin/body/master')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"> Confirmed Reservations</h4>
                <a href="{{ route('reservations.create') }}" class="btn btn-inverse-primary">Add New</a>


                </p>
                <div class="table-responsive">

                    <table id="reservations-table" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Guests</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Status</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reservations as $reservation)
                                @php
                                    // Determine button class based on reservation status
                                    $buttonClass = '';
                                    if ($reservation->status == 'In Progress') {
                                        $buttonClass = 'btn-inverse-primary';
                                    } elseif ($reservation->status == 'Rejected') {
                                        $buttonClass = 'btn-inverse-danger';
                                    } elseif ($reservation->status == 'Confirmed') {
                                        $buttonClass = 'btn-inverse-success';
                                    } elseif ($reservation->status == 'Cancelled') {
                                        $buttonClass = 'btn-inverse-warning';
                                    }
                                @endphp

                                <tr>
                                    <td>{{ $reservation->name }}</td>
                                    <td class="description">{{ $reservation->number_of_guests }}</td>
                                    <td>{{ $reservation->date }}</td>
                                    <td>{{ $reservation->time }}</td>
                                    <td>
                                        <button class="btn {{ $buttonClass }}">
                                            {{ $reservation->status }}
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
