<nav class="navbar navbar-expand-lg bg-custome">
    <div class="container-fluid justify-content-end  w-100">
        <!-- <a class="navbar-brand" href="#">Navbar</a> -->
        <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto w-100 mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link nav-btn active text-white" aria-current="page" href="/home">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link nav-btn text-white position-relative" href="/vendor-cart"> Cart
                        <span class="position-absolute top-1 start-100 translate-middle badge rounded-circle bg-danger card-badge">
                        </span></a>
                </li>
                <li class="nav-item dropdown d-lg-none d-sm-block">
                    <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Product
                    </a>
                    <ul class="dropdown-menu bg-custome text-white w-75 border border-white">
                        <li><a class="dropdown-item text-white" href="/all-product">All Product</a></li>
                        <li>
                            <hr class="dropdown-divider border border-white">
                        </li>
                        <li><a class="dropdown-item text-white" href="/add-new-product">Add New</a></li>
                        <li>
                            <hr class="dropdown-divider border border-white">
                        </li>

                        <li><a class="dropdown-item text-white" href="/category">Category</a></li>
                        <li>
                            <hr class="dropdown-divider border border-white">
                        </li>
                        <li><a class="dropdown-item text-white" href="/attributes">Attribute</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown d-lg-none d-sm-block">
                    <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Order
                    </a>
                    <ul class="dropdown-menu bg-custome text-white w-75 border border-white">
                        <li><a class="dropdown-item text-white" href="#">All Order</a></li>
                        <li>
                            <hr class="dropdown-divider border border-white">
                        </li>
                        <li><a class="dropdown-item text-white" href="#">Customer</a></li>
                        <li>
                            <hr class="dropdown-divider border border-white">
                        </li>
                        <li><a class="dropdown-item text-white" href="#">Status</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown d-lg-none d-sm-block">
                    <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Settings
                    </a>
                    <ul class="dropdown-menu bg-custome text-white w-75 border border-white">
                        <li><a class="dropdown-item text-white" href="#">Product Tresh</a></li>
                    </ul>
                </li>


            </ul>
            <form class="d-flex w-100" role="search">
                <input class="form-control form-control1 me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-white text-white">Search</button>
            </form>
            <div>
                <a class="btn bg-custome text-white btn-outline-white mx-lg-3 my-2 " href="logout">Logout</a>
            </div>
        </div>
    </div>
</nav>