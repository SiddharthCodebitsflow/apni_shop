@include('../include/header/header')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-2 d-lg-block sidebar-fix position-fixed d-none border-end h-100">
            <div class="accordion sidebar-button px-2" id="accordionExample">
                <h5 class="my-1 d-flex text-center my-3 border border-dark px-2 py-3">Apni Shop Online</h5>
                <div class="accordion-item mt-1">
                    <h2 class="accordion-header " id="headingOne">
                        <a href="/home" class="accordion-button text-decoration-none collapsed text-white sidebar-col">Home</a>
                    </h2>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header " id="headingOne">
                        <button class="accordion-button text-white sidebar-col collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Product <strong class="w-100 text-end">></strong>
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body background">
                            <a href="/all-product" class="nav-link  sidebar-col rounded px-2 py-2 text-white">All Product</a>
                            <a href="/add-new-product" class="nav-link sidebar-col mt-1 rounded px-2 py-2 text-white">Add new</a>
                            <a href="/category" class="nav-link sidebar-col mt-1 rounded px-2 py-2 text-white">Cateogry</a>
                            <a href="/attributes" class="nav-link sidebar-col mt-1 rounded px-2 py-2 text-white">Attributes</a>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button text-white sidebar-col collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                            Order <strong class="w-100 text-end">></strong>
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="accordion-body background">
                            <a href="/all-order" class="nav-link sidebar-col rounded px-2 py-2 text-white">All Order</a>
                            <a href="#" class="nav-link sidebar-col rounded px-2 mt-1 py-2 text-white">Customer</a>
                            <a href="#" class="nav-link sidebar-col rounded px-2 mt-1 py-2 text-white">status</a>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button text-white sidebar-col collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                            Settings<strong class="w-100 text-end">></strong>
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">

                        <div class="accordion-body background">
                            <a href="/profile" class="nav-link sidebar-col rounded px-2 py-2 mb-2 text-white">Profile</a>
                            <a href="/tresh-product" class="nav-link sidebar-col rounded px-2 py-2 text-white">Product Tresh</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class=" right-sidebar position-relative top-0 left-0 col-lg-10 p-0 offset-lg-2">
            @include('include/navbar/nav')
            <div class="container-fluid ">