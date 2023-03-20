@include('../include/sidebar/sidebar')

<div class="row card-box">
</div>
@include('../include/footer/footer')
<script>
    $(window).on("load", function() {
        var session_id = "{{session('user_id')}}";
        $.ajax({
            url: window.location.origin + '/api/get-product',
            type: 'POST',
            dataType: 'json',
            data: {
                session: session_id
            },
            success: function(data) {
                if (data.status == 200) {
                    for (var i in data.data) {
                        if (Object.keys(data.data[i].relationship).length == 0) {
                            $('.card-box').append('<div class="col-md-4 col-sm-6 mt-4"><div class="card"><a href="/about-product/'+data.data[i].id+'"><img  src="' + data.data[i].product_image + '" class="product-image card-img-top" alt=""></a><div class="card-body"> <h5 class="card-title">' + data.data[i].product_name + '</h5> <div class="row"><div class="col-6"><p class="card-text mt-1"><s>Rs.' + data.data[i].regular_price + '</s></p></div><div class="col-6"><p class="card-text mt-1">Rs.' + data.data[i].vendor_price + '</p></div></div><p class="card-text"></p><div class="row"><div class="col-6"><a href="#" class="btn bg-custome text-white mt-1">Buy Now</a></div><div class="col-6"><button class="btn bg-custome text-white mt-1" onclick="add_to_cart(' + data.data[i].id + ')" >Add to Cart</button></div></div> </div> </div> </div>');
                        } else {
                            $('.card-box').append('<div class="col-md-4 col-sm-6 mt-4"><div class="card"><a href="/about-product/'+data.data[i].id+'"><img  src="' + data.data[i].product_image + '" class="product-image card-img-top" alt=""></a><div class="card-body"> <h5 class="card-title">' + data.data[i].product_name + '</h5> <div class="row"><div class="col-6"><p class="card-text mt-1"><s>Rs.' + data.data[i].regular_price + '</s></p></div><div class="col-6"><p class="card-text mt-1">Rs.' + data.data[i].vendor_price + '</p></div></div><p class="card-text"></p><div class="row"><div class="col-6"><a href="#" class="btn bg-custome text-white mt-1">Buy Now</a></div><div class="col-6"><a class="btn btn-outline-success mt-1" href="/vendor-cart" >View Cart</a></div></div> </div> </div> </div>');
                        }
                    }
                } else {

                }
            }
        })
    });

    function add_to_cart(product_id) {
        var session_id = "{{session('user_id')}}";
        $.ajax({
            url: window.location.origin + '/api/add-to-cart',
            type: 'POST',
            dataType: 'json',
            data: {
                session: session_id,
                product_id: product_id
            },
            success: function(data) {
                location.reload();
            }
        })
    }
</script>
