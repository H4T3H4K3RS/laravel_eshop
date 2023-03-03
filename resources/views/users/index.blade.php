@extends('layouts.app')

@section('title', 'Users')

@section('content')
    <div class="row">
        <div class="col-8">
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">@</span>
                <input type="text" id="search" onkeyup="search()" class="form-control" placeholder="Search"
                       aria-label="Username" aria-describedby="basic-addon1">
            </div>
        </div>
    </div>
    <table class="table table-responsive">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Role</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody id="tbody">
        @foreach($users as $user)
            <tr id="{{ $user->name }}_{{ $user->email }}_{{ $user->is_admin ? "Admin" : "User" }}">
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->is_admin ? "Admin" : "User" }}</td>
                <td>
                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-primary">
                        <img
                            src="https://static.vecteezy.com/system/resources/previews/009/393/680/original/eye-icon-sign-symbol-design-free-png.png"
                            alt="" height="15px">
                    </a>
                    @guest
                    @else
                        @if(auth()->user()->is_admin)
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning">
                                <img src="https://www.svgrepo.com/show/42233/pencil-edit-button.svg" alt=""
                                     height="15px">
                            </a>
                            <form method="POST" action="{{ route('users.destroy', $user->id) }}"
                                  class="d-inline-flex"
                                  onsubmit="return confirmSubmit(event, 'Are you sure you want to delete user {{$user->name}}?')"
                            >
                                @csrf
                                @method("DELETE")
                                <button class="btn btn-danger btn-sm">
                                    <img src="https://cdn-icons-png.flaticon.com/512/1345/1345874.png"
                                         alt="" height="15px"></button>
                            </form>
                        @endif
                    @endguest
                </td>
            </tr>
        @endforeach
        </tbody>
        @if ($users->count() == 0)
            <tfoot>
            <tr>
                <td
                    colspan="12"
                    class="text-center text-body-1 justify-center align-center"
                >
                    No users(
                </td>
            </tr>
            </tfoot>
        @endif
        {{--        <tbody>--}}
        {{--        @foreach($users as $user)--}}
        {{--            <h3>{{ $user->name }}</h3>--}}
        {{--        @endforeach--}}
        {{--        </tbody>--}}
    </table>
    <!-- Modal -->

@endsection
