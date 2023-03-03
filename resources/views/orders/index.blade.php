@extends('layouts.app')

@section('title', 'Orders')

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
            <th scope="col">User</th>
            <th scope="col">Products</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody id="tbody">
        @foreach($orders as $order)
            <tr id="{{ $order->name }}_{{$order->user->email}}">
                <td>{{ $order->id }}</td>
                <td>{{ $order->user->email }}</td>
                <td>{{ $order->products }}</td>
                <td>
                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-primary">
                        <img
                            src="https://static.vecteezy.com/system/resources/previews/009/393/680/original/eye-icon-sign-symbol-design-free-png.png"
                            alt="" height="15px">
                    </a>
                    @guest
                    @else
                        @if(auth()->user()->is_admin)
                            <form method="POST" action="{{ route('orders.destroy', $order->id) }}"
                                  class="d-inline-flex"
{{--                                  onsubmit="return confirmSubmit(event, 'Are you sure you want to delete order {{$order->name}}?')"--}}
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
        @if ($orders->count() == 0)
            <tfoot>
            <tr>
                <td
                    colspan="12"
                    class="text-center text-body-1 justify-center align-center"
                >
                    No orders(
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
