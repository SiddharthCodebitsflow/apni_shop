@include('../user_include/header/user_header')


<div class="row card-box mb-4">
</div>
@include('../user_include/footer/user_footer')

<script>
    $(window).on("load", function() {
        $.ajax({
            url: window.location.origin + '/api/user-product',
            type: 'POST',
            dataType: 'json',
            success: function(data) {
                console.log(data);
                if (data.status == 200) {
                    for (var i in data.data) {
                        $('.card-box').append('<div class="col-md-3 col-sm-4 mt-4"><div class="card"><a href="/user-about-product/' + data.data[i].id + '"><img  src="' + data.data[i].product_image + '" class="product-image card-img-top" alt=""></a><div class="card-body"> <h5 class="card-title">' + data.data[i].product_name + '</h5> <div class="row"><div class="col-6"><p class="card-text mt-1"><s>Rs.' + data.data[i].regular_price + '</s></p></div><div class="col-6"><p class="card-text mt-1">Rs.' + data.data[i].vendor_price + '</p></div></div><p class="card-text"></p><div class="row"><div class="col-12"><a href="/user-about-product/' + data.data[i].id + '" class="btn bg-custome text-white mt-1">Go to Details Page</a></div> </div> </div> </div>');
                    }
                } else {

                }
            }
        })
    });
</script>