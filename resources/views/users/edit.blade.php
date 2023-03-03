@extends('layouts.app')

@section('title', 'Edit')

@section('content')
    <div class="card">
        <div class="card-header">
            Товар
        </div>
        <div class="card-body">

            <form method="POST" action="{{ route('users.update', $user->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}">
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Email</label>
                    <input type="text" class="form-control" name="email" id="email" value="{{ $user->email }}">
                </div>

                <button type="submit" class="btn btn-success btn-sm">Save</button>
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
                <a href="/users">
                    <button type="button" class="btn btn-primary btn-sm">Cancel</button>
                </a>
            </form>
        </div>
    </div>
@endsection
