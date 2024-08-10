@extends('admin/body/master')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Foods</h4>
                <a href="{{ route('foods.create') }}" class="btn btn-inverse-primary">Add New</a>

                <div class="table-responsive">
                    <table id="reservations-table" class="table table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">Image</th>
                                <th class="text-center">Title Type</th>
                                <th class="text-center">Description</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($foods as $food)
                                <tr>
                                    <td class="py-1 text-center"">
                                        <img src="{{ asset('admin/user_images/' . $food->image) }}"
                                            alt="{{ $food->title }}" style="max-width: 100px;">
                                    </td>
                                    <td class="text-center">{{ $food->title }}</td>
                                    <td class="text-center description">{{ $food->description }}</td>
                                    <td class="text-center">
                                        <form id="delete-form-{{ $food->id }}"
                                            action="{{ route('foods.destroy', $food->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')

                                            <a href="/foods/{{ $food->id }}/edit" class="btn btn-inverse-primary">
                                                <i class="mdi mdi-border-color"></i>
                                            </a>
                                            <button type="button" class="btn btn-inverse-danger"
                                                onclick="confirmDelete({{ $food->id }})">
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

    <style>
        .description {
            max-width: 200px;
            /* Adjust based on your layout */
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
    </style>
@endsection
