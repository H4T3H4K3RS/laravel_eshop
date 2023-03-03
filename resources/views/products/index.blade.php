@extends('layouts.app')

@section('title', 'Products')

@section('content')
    <div class="row">
        <div class="col-8">
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">@</span>
                <input type="text" id="search" onkeyup="search()" class="form-control" placeholder="Search"
                       aria-label="Username" aria-describedby="basic-addon1">
            </div>
        </div>
        <div class="col-4">
            @guest
            @else
                @if(auth()->user()->is_admin)
                    <a href="{{ route('products.create') }}" class="btn w-100 btn-primary rounded">Create</a>
                @endif
            @endguest
        </div>
    </div>
    <table class="table table-responsive">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Category</th>
            <th scope="col">Image</th>
            <th scope="col">Price</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody id="products">
        @foreach($products as $product)
            <tr id="{{ $product->name }}_{{ $product->category }}_{{ $product->price }}">
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->category }}</td>
                <td><img src="{{ $product->href }}" height="70px" width="70px"></td>
                <td>{{ $product->price }}</td>
                <td>
                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-primary">
                        <img
                            src="https://static.vecteezy.com/system/resources/previews/009/393/680/original/eye-icon-sign-symbol-design-free-png.png"
                            alt="" height="15px">
                    </a>
                    @guest
                    @else
                        <button id="add_product_{{ $product->id }}" type="button"
                                onclick="add_to_cart('{{ $product->id }}', '{{$product->name}}');"
                                class="btn btn-success btn-sm">
                            <img src="https://icons.veryicon.com/png/o/miscellaneous/small-icons-1/ic-add-to-cart.png"
                                 alt="" height="20px">
                        </button>
                        @if(auth()->user()->is_admin)
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning">
                                <img src="https://www.svgrepo.com/show/42233/pencil-edit-button.svg" alt=""
                                     height="15px">
                            </a>
                            <form method="POST" action="{{ route('products.destroy', $product->id) }}"
                                  class="d-inline-flex"
                                  onsubmit="return confirmSubmit(event, 'Are you sure you want to delete product {{$product->name}}?')"
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
        @if ($products->count() == 0)
            <tfoot>
            <tr>
                <td
                    colspan="12"
                    class="text-center text-body-1 justify-center align-center"
                >
                    No products(
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
