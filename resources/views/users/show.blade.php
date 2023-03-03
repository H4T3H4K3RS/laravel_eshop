@extends('layouts.app')

@section('title', 'Товар')

@section('content')
    <div class="card">
        <div class="card-header">
            Name: {{ $user->name }}
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-8">
                    <p>Email: {{$user->email}}</p>
                </div>
            </div>
        </div>
        <div class="row">
            @guest

            @else
                @if(auth()->user()->is_admin)
                    <div class="col-1">
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning">
                            Edit
                        </a>
                    </div>

                    <div class="col-1">
                        <form method="POST" action="{{ route('users.destroy', $user->id) }}"
                              class="d-inline-flex"
                              onsubmit="return confirmSubmit(event, 'Are you sure you want to delete user {{$user->name}}?')"
                        >
                            @csrf
                            @method("DELETE")
                            <button class="btn btn-danger btn-sm">
                                Delete
                            </button>
                        </form>
                    </div>

                    <div class="col-1">
                        <a class="btn btn-primary btn-sm" href="/users">All</a>
                    </div>
                @else

                    <div class="col-1">
                        <a class="btn btn-primary btn-sm" href="/users">All</a>
                    </div>
                @endif
            @endguest
        </div>
    </div>
@endsection
