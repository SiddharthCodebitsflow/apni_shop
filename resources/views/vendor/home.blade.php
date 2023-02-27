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
                for (var i in data.data) {
                    // console.log(data.data[i].);
                    $('.card-box').append('<div class="col-md-4 mt-4"><div class="card"><a href="#"><img  src="'+data.data[i].product_image+'" class="product-image card-img-top" alt=""></a><div class="card-body"> <h5 class="card-title">'+data.data[i].product_name+'</h5><p class="card-text"></p><div class="row"><div class="col-md-6"><a href="#" class="btn bg-custome text-white">Buy Now</a></div><div class="col-md-6"><a href="#" class="btn bg-custome text-white">Add to Cart</a></div></div> </div> </div> </div>');
                }
            }
        })
    });
</script>