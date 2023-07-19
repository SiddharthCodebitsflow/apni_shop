@include('../user_include/header/user_header')
<div class="container-fluid">

    <div class="row card-box mb-4 ">
        @foreach ($product as $product)
            <div class="col-md-3 col-sm-4 mt-4">
                <div class="card background"><a href="/user-about-product/{{ $product->id }}"><img width="100%" src="{{ $product->product_image }}" alt="Not Found"></a>
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->product_name }}</h5>
                        <div class="row">
                            <div class="col-6">
                                <p class="card-text mt-1"><s>Rs.{{ $product->regular_price }}</s></p>
                            </div>
                            <div class="col-6">
                                <p class="card-text mt-1">Rs.{{ $product->sale_price }}</p>
                            </div>
                        </div>
                        <p class="card-text"></p>
                        <div class="row">
                            <div class="col-12"><a href="/user-about-product/{{ $product->id }}"
                                    class="btn bg-custome text-white mt-1">Go to Details Page</a></div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@include('../user_include/footer/user_footer')
