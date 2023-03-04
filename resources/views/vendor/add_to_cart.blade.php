@include('../include/sidebar/sidebar')

<div class="row cart-box">
</div>
@include('../include/footer/footer')
<script>
    $(window).on("load", function() {
        var session_id = "{{session('user_id')}}";
        $.ajax({
            url: window.location.origin + '/api/vendor-cart',
            type: 'POST',
            dataType: 'json',
            data: {
                session: session_id
            },
            success: function(data) {
                console.log(data);
                if (data.status == 200) {
                    for (var i in data.data) {
                        $('.cart-box').append('<div class="col-md-4 col-sm-6 mt-4"><div class="card"><a href="/about-product/'+data.data[i].relationship.id+'"><img  src="' + data.data[i].relationship.product_image + '" class="product-image card-img-top" alt=""></a><div class="card-body"> <h5 class="card-title">' + data.data[i].relationship.product_name + '</h5> <div class="row"><div class="col-6"><p class="card-text mt-1"><s>Rs.' + data.data[i].relationship.regular_price + '</s></p></div><div class="col-6"><p class="card-text mt-1">Rs.' + data.data[i].relationship.vendor_price + '</p></div></div><p class="card-text"></p><div class="row"><div class="col-6"><a href="#" class="btn bg-custome text-white mt-1">Buy Now</a></div><div class="col-6"><button class="btn btn-outline-success mt-1" onclick="remove_to_cart(' + data.data[i].id + ')" >Remove</button></div></div> </div> </div> </div>');
                    }
                } else {

                }
            }
        })
    });

    function remove_to_cart(cart_id) {
        $.ajax({
            url: window.location.origin + '/api/remove-cart',
            type: 'POST',
            dataType: 'json',
            data: {
                cart_id: cart_id
            },
            success: function(data) {
                if (data.status == 200) {
                    location.reload();
                }
            }
        })
    }
</script>