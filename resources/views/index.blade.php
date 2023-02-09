@include('include/header/header')
<div class="container">
    <div class="mx-auto my-5 text-color-custom text-center">
        <h1 >Are you vendor or User </h1>
        <div class="my-5">
        <a class="bg-custome text-white text-decoration-none my-3 mx-2 h5 px-2 py-2 rounded-pill my-5" href="{{'user/user-register'}}">Use For User</a>
        <a class="bg-custome text-white text-decoration-none mx-2 h5 px-2 py-2 rounded-pill" href="{{'vendor-register'}}">Use For Vendor</a>
    </div>
    </div>
</div>
@include('include/footer/footer')