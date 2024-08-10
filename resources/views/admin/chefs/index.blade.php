@extends('admin/body/master')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">chefs</h4>
                <a href="{{ route('chefs.create') }}" class="btn btn-inverse-primary">Add New</a>


                </p>
                <div class="table-responsive">

                    <table id="reservations-table" class="table table-striped">

                        <thead>
                            <tr>

                                <th> Image </th>
                                <th> Name </th>
                                <th> Role </th>
                                <th> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($chefs as $chef)
                                <tr>
                                    <td class="py-1">
                                        <img src="{{ asset('admin/chefs_images/' . $chef->image) }}"
                                            alt="{{ $chef->title }}" ">
                                                    </td>
                                                    <td> {{ $chef->name }} </td>

                                                    <td class="description"> {{ $chef->role }}</td>
                                                    <style>
                                                        .description {
                                                            max-width: 200px; /* Adjust based on your layout */
                                                            overflow: hidden;
                                                            text-overflow: ellipsis;
                                                            white-space: nowrap;
                                                        }
                                                    </style>

                                                   <td>
                    <form id="delete-form-{{ $chef->id }}" action="{{ route('chefs.destroy', $chef->id) }}" method="post">
                        @csrf
                        @method('DELETE')

                        <a href="/chefs/{{ $chef->id }}/edit" class="btn btn-inverse-primary">
                            <i class="mdi mdi-border-color"></i>
                        </a>
                        <button type="button" class="btn btn-inverse-danger" onclick="confirmDelete({{ $chef->id }})">
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
