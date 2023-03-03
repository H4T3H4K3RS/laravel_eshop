@extends('layouts.app')

@section('title', 'Edit')

@section('content')
    <div class="card">
        <div class="card-header">
            Товар
        </div>
        <div class="card-body">

            <form method="POST" action="{{ route('products.update', $product->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ $product->name }}">
                </div>

                <div class="mb-3">
                    <label for="article" class="form-label">Category</label>
                    <input type="text" class="form-control" name="category" id="category"
                           value="{{ $product->category }}">
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Price ($)</label>
                    <input type="number" class="form-control" name="price" id="price" value="{{ $product->price }}">
                </div>

                <div class="mb-3">
                    <label for="article" class="form-label">Image Link</label>
                    <input type="text" class="form-control" name="href" id="href" value="{{ $product->href }}">
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description"
                              rows="3">{{ $product->description }}</textarea>
                </div>

                <button type="submit" class="btn btn-success btn-sm">Save</button>
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
                <a href="{{ route('products.index') }}">
                    <button type="button" class="btn btn-primary btn-sm">Cancel</button>
                </a>
            </form>
        </div>
    </div>
@endsection
