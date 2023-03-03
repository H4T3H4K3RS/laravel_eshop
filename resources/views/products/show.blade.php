@extends('layouts.app')

@section('title', 'Товар')

@section('content')
    <div class="card">
        <div class="card-header">
            Name: {{ $product->name }}
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-8">
                    <p>Category: {{ $product->category }}</p>
                    <p>Price: {{ $product->price }} $</p>
                    <p>Description: {{ $product->description }}</p>
                </div>
                <div class="col-4">
                    <img src="{{ $product->href }}" width="300" height="300">
                </div>
            </div>
        </div>
        <div class="row">
            @guest

            @else
                @if(auth()->user()->is_admin)
                    <div class="col-1">
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning">
                            Edit
                        </a>
                    </div>

                    <div class="col-1">
                        <form method="POST" action="{{ route('products.destroy', $product->id) }}"
                              class="d-inline-flex"
                              onsubmit="return confirmSubmit(event, 'Are you sure you want to delete product {{$product->name}}?')"
                        >
                            @csrf
                            @method("DELETE")
                            <button class="btn btn-danger btn-sm">
                                Delete
                            </button>
                        </form>
                    </div>

                    <div class="col-1">
                        <a class="btn btn-primary btn-sm" href="/products">All</a>
                    </div>
                @else

                    <div class="col-1">
                        <a class="btn btn-primary btn-sm" href="/products">All</a>
                    </div>
                @endif
            @endguest
        </div>
    </div>
@endsection
