@extends('admin/body/master')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Events</h4>
                <a href="{{ route('events.create') }}" class="btn btn-inverse-primary">Add New</a>

                <div class="table-responsive">
                    <table id="reservations-table" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($events as $event)
                                <tr>
                                    <td class="py-1">
                                        <img src="{{ asset('admin/event_images/' . $event->image) }}"
                                            alt="{{ $event->title }}">
                                    </td>
                                    <td>{{ $event->title }}</td>
                                    <td>{{ $event->time }}</td>
                                    <td>{{ $event->date }}</td>
                                    {{-- <td class="description">{{ $chef->role }}</td> --}}
                                    <td>
                                        <form id="delete-form-{{ $event->id }}"
                                            action="{{ route('events.destroy', $event->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')

                                            <a href="/events/{{ $event->id }}/edit" class="btn btn-inverse-primary">
                                                <i class="mdi mdi-border-color"></i>
                                            </a>
                                            <button type="button" class="btn btn-inverse-danger"
                                                onclick="confirmDelete({{ $event->id }})">
                                                <i class="mdi mdi-delete"></i>
                                            </button>
                                        </form>
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
