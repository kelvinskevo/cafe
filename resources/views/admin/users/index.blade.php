@extends('admin/body/master')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Users</h4>
                <p class="card-description"> Active <code>Users</code>
                </p>
                <div class="table-responsive">
                    <table id="reservations-table" class="table table-striped">
                        <thead>
                            <tr>
                                <th> User </th>
                                <th> Name </th>
                                <th> User Type </th>
                                <th> Email </th>
                                <th> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td class="py-1">
                                        <img src="{{ asset('admin/assets/images/faces-clipart/pic-1.png') }}" alt="image">
                                    </td>
                                    <td> {{ $user->name }} </td>
                                    <td>
                                        {{ $user->usertype == 1 ? 'ADMIN' : 'USER' }}
                                    </td>
                                    <td> {{ $user->email }}</td>
                                    <td>
                                        <form action="{{ route('users.destroy', ['id' => $user->id]) }}" method="post">
                                            @csrf
                                            @method('DELETE')

                                            <a href="/users/{{ $user->id }}/edit" class="btn btn-inverse-primary"><i
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
