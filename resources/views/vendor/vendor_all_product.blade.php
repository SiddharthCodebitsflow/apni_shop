@include('../include/sidebar/sidebar')
<div class="row card-box">
</div>
@include('../include/footer/footer')

<script>
    $(window).on("load", function() {
        var session_id = "{{session('user_id')}}";
        $.ajax({
            url: window.location.origin + '/api/get-vendor-product',
            type: 'POST',
            dataType: 'json',
            data: {
                session: session_id
            },
            success: function(data) {
                if (data.status == 200) {
                    for (var i in data.data) {
                        // console.log(data.data[i].);
                        $('.card-box').append('<div class="col-md-4 col-sm-6 my-4"><div class="card"><a href="#"><img  src="' + data.data[i].product_image + '" class="product-image card-img-top" alt=""></a><div class="card-body"> <h5 class="card-title">' + data.data[i].product_name + '</h5><div class="row"><div class="col-6"><a href="/about-product/'+data.data[i].id+'" class="btn bg-custome text-white">About</a></div><div class="col-6"><button onclick="delete_product('+data.data[i].id+')" class="btn bg-custome text-white">Delete</button></div></div>');
                    }
                } else {

                }
            }
        })
    });
    function delete_product(product_id) {
        $.ajax({
            url: window.location.origin + '/api/delete-product',
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