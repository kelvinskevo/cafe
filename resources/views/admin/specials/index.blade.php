@extends('admin/body/master')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h1>Specials</h1>
                <hr>
            </div>
        </div>
    </div>

    {{-- this week specials --}}
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">This Week's Specials</h4>
                <hr>
                <a href="{{ route('specials.create') }}" class="btn btn-inverse-primary">Add New</a>
                <div class="table-responsive">
                    <table id="reservations-table" class="table table-striped">
                        <thead>
                            <tr>
                                <th> Image </th>
                                <th> Category </th>
                                <th> Name </th>
                                <th> Price </th>
                                <th> Week Start </th>
                                <th> Description</th>
                                <th> Actions </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($current as $special)
                                <tr>
                                    <td class="py-1">
                                        <img src="{{ asset('admin/special_images/' . $special->image) }}"
                                            alt="{{ $special->name }}" style="max-width: 100px;">
                                    </td>
                                    <td> {{ $special->category }} </td>
                                    <td> {{ $special->name }} </td>
                                    <td>$ {{ $special->price }} </td>
                                    <td> {{ $special->week_start }} </td>
                                    <td class="description"> {{ $special->description }} </td>
                                    <style>
                                        .description {
                                            max-width: 200px;
                                            /* Adjust based on your layout */
                                            overflow: hidden;
                                            text-overflow: ellipsis;
                                            white-space: nowrap;
                                        }
                                    </style>
                                    <td>
                                        <form id="delete-form-{{ $special->id }}"
                                            action="{{ route('specials.destroy', $special->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{ route('specials.edit', $special->id) }}"
                                                class="btn btn-inverse-primary">
                                                <i class="mdi mdi-border-color"></i>
                                            </a>
                                            <button type="button" class="btn btn-inverse-danger"
                                                onclick="confirmDelete({{ $special->id }})">
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

    {{-- future week specials --}}
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Future Week's Specials</h4>
                <hr>
                <a href="{{ route('specials.create') }}" class="btn btn-inverse-primary">Add New</a>
                <div class="table-responsive">
                    <table id="reservations-table" class="table table-striped">
                        <thead>
                            <tr>
                                <th> Image </th>
                                <th> Category </th>
                                <th> Name </th>
                                <th> Price </th>
                                <th> Week Start </th>
                                <th> Description</th>
                                <th> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($future as $special)
                                <tr>
                                    <td class="py-1">
                                        <img src="{{ asset('admin/special_images/' . $special->image) }}"
                                            alt="{{ $special->name }}">
                                    </td>
                                    <td> {{ $special->category }} </td>
                                    <td> {{ $special->name }} </td>
                                    <td> {{ $special->price }} </td>
                                    <td> {{ $special->week_start }} </td>
                                    <td class="description"> {{ $special->description }}</td>
                                    <td>
                                        <form id="delete-form-{{ $special->id }}"
                                            action="{{ route('specials.destroy', $special->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <a href="/specials/{{ $special->id }}/edit" class="btn btn-inverse-primary">
                                                <i class="mdi mdi-border-color"></i>
                                            </a>
                                            <button type="button" class="btn btn-inverse-danger"
                                                onclick="confirmDelete({{ $special->id }})">
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

    {{-- past week specials --}}
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Past Week's Specials</h4>
                <hr>
                <a href="#" class="btn btn-inverse-primary">Print</a>
                <div class="table-responsive">
                    <table id="reservations-table" class="table table-striped">
                        <thead>
                            <tr>
                                <th> Image </th>
                                <th> Category </th>
                                <th> Name </th>
                                <th> Price </th>
                                <th> Week Start </th>
                                <th> Description</th>
                                <th> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($previous as $special)
                                <!-- Ensure that $pastSpecials is being passed from the controller -->
                                <tr>
                                    <td class="py-1">
                                        <img src="{{ asset('admin/special_images/' . $special->image) }}"
                                            alt="{{ $special->name }}">
                                    </td>
                                    <td> {{ $special->category }} </td>
                                    <td> {{ $special->name }} </td>
                                    <td> {{ $special->price }} </td>
                                    <td> {{ $special->week_start }} </td>
                                    <td class="description"> {{ $special->description }}</td>
                                    <td>
                                        <form id="delete-form-{{ $special->id }}"
                                            action="{{ route('specials.destroy', $special->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-inverse-danger"
                                                onclick="confirmDelete({{ $special->id }})">
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
