@include('include/header/header')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 ps-0 opacity-75 image">
            <h1 class="text-danger my-5 mx-3">Welcome To</h1>
            <h1 class="text-danger fst-italic text-center ">Apni shop Online </h1>
            <div class="mx-auto my-5 d-lg-none d-block text-color-custom text-center">
                <h1 class="fst-italic">Are you vendor or User </h1>
                <div class="my-5">
                    <div class="my-5">
                        <a class="bg-custome  btn text-white w-50 rounded-pill" href="{{'user-home'}}">Use For User</a>
                    </div>
                    <div>
                        <a class="bg-custome  btn text-white w-50 rounded-pill text-bold" href="{{'vendor-register'}}">Use For Vendor</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mx-auto d-lg-block d-none my-5 text-color-custom text-center">
                <h1 class="fst-italic">Are you vendor or User </h1>
                <div class="my-5">
                    <div class="my-5">
                        <a class="bg-custome  btn text-white w-50 rounded-pill" href="{{'user-home'}}">Use For User</a>
                    </div>
                    <div>
                        <a class="bg-custome  btn text-white w-50 rounded-pill text-bold" href="{{'vendor-register'}}">Use For Vendor</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('include/footer/footer')