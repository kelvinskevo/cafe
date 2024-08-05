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

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reservations as $reservation)
                                <tr>
                                    <td>{{ $reservation->name }}</td>

                                    <td class="description"> {{ $reservation->number_of_guests }}</td>
                                    <td>{{ $reservation->date }}</td>
                                    <td>{{ $reservation->time }}</td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
