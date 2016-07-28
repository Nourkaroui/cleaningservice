@extends('admin.dash')

@section('content')

    <div class="container-fluid" id="admin-product-container">

        <br><br>
        <a href="#menu-toggle" class="btn btn-default" id="menu-toggle"><i class="fa fa-bars fa-5x"></i></a>

        <a href="{{ route('admin.user.admin.add') }}" class="btn btn-primary">Add new Admin Or Manager</a>
        <br><br>

        <h6>There are {{ $userCount }} Users</h6><br>


        <table class="table table-bordered table-condensed table-hover">
            <thead>
            <tr>
                <th class="text-center blue white-text">Delete</th>
                <th class="text-center blue white-text">Edit</th>
                <th class="text-center blue white-text">email</th>
                <th class="text-center blue white-text">Username</th>
                <th class="text-center blue white-text">First name</th>
                <th class="text-center blue white-text">Last name</th>
                <th class="text-center blue white-text">Address</th>
                <th class="text-center blue white-text">City</th>
                <th class="text-center blue white-text">Zip</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td class="text-center">
                        <form method="post" action="{{ route('admin.delete', $user->id) }}" class="delete_form_product">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="DELETE">
                            <button id="delete-product-btn">
                                <i class="material-icons red-text">delete_forever</i>
                            </button>
                        </form>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('admin.user.driver.edit', $user->id) }}">
                            <i class="material-icons green-text">mode_edit</i>
                        </a>
                    </td>

                    <td class="text-center">{{ $user->email }}</td>
                    <td class="text-center">{{ $user->Username }}</td>
                    <td class="text-center">{{ $user->first_name }}</td>
                    <td class="text-center">{{ $user->last_name }}</td>
                    <td class="text-center">{{ $user->address }}</td>
                    <td class="text-center">{{ $user->city }}</td>
                    <td class="text-center">{{ $user->zip }}</td>

                </tr>
            @endforeach
            </tbody>
        </table>



    </div>

@endsection