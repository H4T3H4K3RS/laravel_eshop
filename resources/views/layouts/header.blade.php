<header class="p-3 mb-3 border-bottom">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-between mb-md-0 align-items-center">
                <li>
                    <a href="/" class="nav-link px-2 link-secondary">
                        <img src="https://i.ibb.co/X47BSBV/needmilk.png" alt="Logo" height="50">
                    </a>
                </li>
                <li>
                @auth
                @endauth
                <li><a href="{{ route('products.index') }}" class="nav-link px-2 link-dark">Products</a></li>

                <!-- Button trigger modal -->


            </ul>
            @guest
            @else
                <div class="text-end">
                    <button type="button" class="btn btn-sm text-end" style="margin-right: 10px"
                            data-bs-toggle="modal" data-bs-target="#cartModal"
                    >
                        <img src="https://www.freeiconspng.com/thumbs/cart-icon/basket-cart-icon-27.png" height="20px"
                             alt="">
                    </button>
                </div>
            @endguest
            <div class="dropdown text-end">
                <a href="" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1"
                   data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://www.pngmart.com/files/21/Account-Avatar-Profile-PNG-Photo.png" alt="mdo"
                         class="rounded-circle" width="32" height="32">
                    @guest
                        Unauthorized
                    @else
                        {{auth()->user()->email}}
                    @endguest
                </a>
                <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
                    @guest
                        <li><a class="dropdown-item" href="{{ route('login') }}">Login</a></li>
                        <li><a class="dropdown-item" href="{{ route('register') }}">Register</a></li>
                    @else
                        @if(auth()->user()->is_admin)
                            <li class="nav-link px-2"><a class="dropdown-item">Admin</a></li>
                        @else
                            <li class="nav-link px-2"><a class="dropdown-item">User</a></li>
                        @endif
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">Logout</button>
                        </form>
                    @endguest

                </ul>
            </div>
        </div>
    </div>
</header>
<div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cartModalLabel">Cart</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul id="cartData">
                    Empty Cart(
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="clearCart();" class="btn btn-danger" data-bs-dismiss="modal">Clear
                    Cart
                </button>
                <button type="button" onclick="sendOrder();" class="btn btn-success" data-bs-dismiss="modal">
                    Checkout
                </button>
            </div>
        </div>
    </div>
</div>
