@include('../include/sidebar/sidebar')
<div class="container">
    <div class="row product-box">

    </div>

    <div class="row add-info">

    </div>
</div>
@include('../include/footer/footer')

<script>
    $(window).on("load", function() {
        let product_id = "{{$product_id}}";
        $.ajax({
            url: window.location.origin + '/api/get-single-product',
            type: 'POST',
            dataType: 'json',
            data: {
                product_id: product_id
            },
            success: function(data) {
                let attribute = JSON.parse(data.data[0].attribute);
                console.log(attribute);

                $('.product-box').append(`
                <div class="col-md-6">
            <div class="card my-5">
                <div class="card-body">
                    <img src="/${data.data[0].product_image}" height="200px" width="100%" alt="">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mx-5">
                <h2 class="mt-5">${data.data[0].product_name}</h2>
                <s>Rs.${data.data[0].regular_price}</s>
                <span class="mx-4">Rs.${data.data[0].vendor_price}</span>
                <div>
                    <div>
                        <label class="h6" for="">Quantity</label>
                    </div>
                    <div>
                        <input min="1" value="1" class="text-center form-control w-50" type="number">
                    </div>
                    <div class="my-4">
                        <button class="btn bg-custome text-white my-2">Add To Cart</button>
                        <button class="btn bg-custome mx-lg-4 my-2 text-white">Process to Checkout</button>
                    </div>
                </div>
            </div>
        </div>
                `);
                $('.add-info').append(`<div class="col-lg-10"> <div class="card"><h6 class="mx-4 my-2">Addition Information</h6><table class="cat-class"><tr><th scope="row">Category</th><td>${data.data[0].category}</td></tr>`);
                Object.entries(attribute).forEach(([key, value]) => {
                    $('.cat-class').append(`<tr> <th scope="row">${key}</th> <td>${value}</td> </tr> </table></div></div>`)
                })

            }
        })
    });
</script>