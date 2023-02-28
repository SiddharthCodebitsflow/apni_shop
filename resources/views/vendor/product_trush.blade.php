@include('../include/sidebar/sidebar')
<div class="row card-box">
</div>
@include('../include/footer/footer')


<script>
    $(window).on("load", function() {
        var session_id = "{{session('user_id')}}";
        $.ajax({
            url: window.location.origin + '/api/trush-product',
            type: 'POST',
            dataType: 'json',
            data: {
                session: session_id
            },
            success: function(data) {
                if (data.status == 200) {
                    // console.log(data);
                    for (var i in data.data) {
                        $('.card-box').append('<div class="col-md-4 col-sm-6 my-4"><div class="card"><a href="#"><img  src="' + data.data[i].product_image + '" class="product-image card-img-top" alt=""></a><div class="card-body"> <h5 class="card-title">' + data.data[i].product_name + '</h5><div class="row"><div class="col-6"><a href="/product/' + data.data[i].id + '" class="btn bg-custome text-white">About</a></div><div class="col-6"><button onclick="recover_product(' + data.data[i].id + ')" class="btn bg-custome text-white">Recover</button></div></div>');
                    }
                } else {

                }
            }
        })
    });

    function recover_product(product_id) {
        $.ajax({
            url: window.location.origin + '/api/recover-product',
            type: 'POST',
            dataType: 'json',
            data: {
                product_id: product_id
            },
            success: function(data) {
                if (data.status == 200) {
                    location.reload();
                }
            }
        })
    }
</script>