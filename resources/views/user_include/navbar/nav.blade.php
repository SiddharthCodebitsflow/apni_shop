<nav class="navbar navbar-expand-lg bg-custome py-0">
    <div class="container-fluid justify-content-end w-100">
        <!-- <a class="navbar-brand" href="#">Navbar</a> -->
        <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto w-100 mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active text-white" aria-current="page" href="/">Home</a>
                </li>
                @if (session()->has('login_id'))
                    <li class="nav-item">
                        <a class="nav-link text-white position-relative" href="/user-cart"> Cart
                            <span
                                class="position-absolute top-1 start-100 translate-middle badge rounded-circle bg-danger card-badge">
                            </span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active text-white" aria-current="page" href="#">Checkout</a>
                    </li>
                @endif
            </ul>
            <form class="d-flex w-100" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-white text-white">Search</button>
            </form>
            @if (session()->has('login_id'))
                <div>
                    <a class="btn bg-custome text-white btn-outline-white mx-lg-3 my-2 " href="/user-logout">Logout</a>
                </div>
            @else
                <div>
                    <a class="btn bg-custome text-white btn-outline-white ms-lg-2 my-2 " href="/user-login">SignIn</a>
                </div>
                <div>
                    <a class="btn bg-custome text-white btn-outline-white ms-lg-2 my-2 "
                        href="/user-register">SingUp</a>
                </div>
            @endif
        </div>
    </div>
</nav>
