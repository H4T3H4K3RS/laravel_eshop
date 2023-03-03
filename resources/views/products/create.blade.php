@extends('layouts.app')

@section('title', 'New product')

@section('content')
    <div class="card">
        <div class="card-header">
            New product
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('products.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Product Name</label>
                    <input type="text" class="form-control" name="name" id="name">
                </div>

                <div class="mb-3">
                    <label for="article" class="form-label">Category</label>
                    <input type="text" class="form-control" name="category" id="category">
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Price ($)</label>
                    <input type="number" class="form-control" name="price" id="price">
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Image Link</label>
                    <input type="text" class="form-control" name="href" id="href">
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                </div>

                <button type="submit" class="btn btn-success">Create</button>
                <a href="/products">
                    <button type="button" class="btn btn-primary">Cancel</button>
                </a>
            </form>
        </div>
    </div>
@endsection
