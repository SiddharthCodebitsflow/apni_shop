@include('../user_include/header/user_header')

{{-- @if (request()->cookie('cart'))
{{request()->cookie('cart')}}
@endif --}}

<div class="container">
    <div class="row product-box mb-4">
    </div>
</div>
@include('../user_include/footer/user_footer')

<script>
    $(window).on("load", function() {
        let product_id = "{{ $product_id }}";
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
                if (data.data[0].relationship.length == 0) {
                    $('.product-box').append(`
                        <div class="col-md-6">
                        <div class="card my-5">
                            <div class="card-body">
                                <img src="/${data.data[0].product_image}" height="200px" width="100%" alt="">
                            </div>
                            <div class="row image-data mx-1"></div>
                        </div>
                      </div>
                    <div class="col-md-6">
                        <div class="mx-lg-5">
                            <h2 class="mt-5">${data.data[0].product_name}</h2>
                            <s>Rs.${data.data[0].regular_price}</s>
                            <span class="mx-4">Rs.${data.data[0].vendor_price}</span>
                            <div>
                                <div>
                                    <label class="h6" for="">Quantity</label>
                                </div>
                                <div>
                                    <input min="1" value="1" class="qty text-center form-control w-50" type="number">
                                </div>
                                <div class="mt-3 size-class">
                                    <lable class="h5">Size: </lable>
                                       <select class="class-option">
                                           <option>Chouse option</option>
                                       </select>
                                </div>
                                <div class="my-4">
                                <button class="btn bg-custome text-white mt-1" onclick="add_to_cart(' ${product_id} ')" >Add to Cart</button>
                                    <button class="btn bg-custome mx-lg-4 my-2 text-white">Process to Checkout</button>
                                </div>
                            </div>
                        </div>
                    </div>
                `);
                } else {
                    $('.product-box').append(`
                        <div class="col-md-6">
                            <div class="card my-5 ">
                                <div class="card-body ">
                                    <img  src="/${data.data[0].product_image}" height="200px" width="100%" alt="">
                                </div>
                                <div class="row image-data" style="margin-right: 1.25rem!important;
                                    margin-left: 0.15rem!important;">
                                </div>
                             </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mx-lg-5">
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
                                    <div class="mt-3 size-class">
                                        <lable class="h5">Size: </lable>
                                        <select class="class-option">
                                            <option>Chouse option</option>
                                        </select>
                                    </div>
                                    <div class="my-4">
                                    <a class="btn btn-outline-success mt-1" href="/vendor-cart" >View Cart</a>
                                        <button class="btn bg-custome mx-lg-4 my-2 text-white">Process to Checkout</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                     `);
                }


                $('.add-info').append(
                    `<div class="col-lg-10"> <div class="card"><h6 class="mx-4    my-2">Additional information</h6><table class="cat-class border"><tr><th scope="row" class="ps-2">Category</th><td class="ps-2">${data.data[0].category}</td> </tr> <tr><th class="ps-2" scope="row">Shipping</th><td class="ps-2">${data.data[0].shipping}</td></tr>`
                    );
                Object.entries(attribute).forEach(([key, value]) => {
                    $('.cat-class').append(
                        `<tr> <th class="ps-2" scope="row">${key}</th> <td class="ps-2">${value}</td> </tr> `
                        )
                    if (key == 'Color' || key == 'color' || key == 'colour' || key ==
                        'Colour') {
                        let color_variation = value.split(',');
                        for (color_variation of color_variation) {
                            $('.image-data').append(` <div class="containera"  style="background-color:${color_variation}">
                            <span style="position:absolute;"></span>
                            <input class="form-check-input colour_checkBox select_option" value="" id="checkBox" type="checkbox">
                            </div>`);
                        }

                    }
                    if (key == 'size' || key == 'Size') {
                        let size_variation = value.split(',');
                        for (size_variation of size_variation) {
                            $('.class-option').append(`<option>${size_variation}</option>`);
                        }
                    } else {
                        $('.size-class').hide();
                    }
                })

                $('.cat-class').append(
                    `<tr> <td class="ps-2" colspan="2">${data.data[0].addition_info}</td> </tr> </table></div></div>`
                    )
            }
        })
    });

    function add_to_cart(product_id) {
        const login_id = "{{ session('login_id') }}";
        const qty = $('.qty').val();
        if (login_id.length == 0) {
            window.location.href = window.location.origin + "/add-cart/" + product_id.trim() + "/" + qty.trim();
        } else {

        }
    }
</script>
