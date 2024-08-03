@extends('admin/body/master')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Foods</h4>
                <a href="{{ route('foods.create') }}" class="btn btn-inverse-primary">Add New</a>


                </p>
                <div class="table-responsive">

                    <table class="table table-striped">
                        
                        <thead>
                            <tr>

                                <th> Image </th>
                                <th> Title Type </th>
                                <th> Description </th>
                                <th> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($foods as $food)
                                <tr>
                                    <td class="py-1">
                                        <img src="{{ asset('admin/user_images/' . $food->image) }}" alt="{{ $food->title }}" ">
                                                                        </td>
                                                                        <td> {{ $food->title }} </td>

                                                                        <td class="description"> {{ $food->description }}</td>
                                                                        <style>
                                                                            .description {
                                                                                max-width: 200px; /* Adjust based on your layout */
                                                                                overflow: hidden;
                                                                                text-overflow: ellipsis;
                                                                                white-space: nowrap;
                                                                            }
                                                                        </style>

                                                                        <td>
                                                                            <form action="{{ route('foods.destroy', $food->id) }}" method="post">
                                                                                @csrf
                                                                                @method('DELETE')

                                                                                <a href="/foods/{{ $food->id }}/edit" class="btn btn-inverse-primary"><i
                                                                                        class="mdi mdi-border-color"></i></a>
                                                                                <button type="submit" class="btn btn-inverse-danger"><i
                                                                                        class="mdi mdi-delete"></i></button>
                                                                            </form>
                                                                            <a class=""></a>
                                                                            <a class=""</a>
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
