@include('../user_include/header/user_header')

<div class="row my-4 overflow-auto">
    <table class="table background">
        <thead>
            <tr>
                <th class="text-center" scope="col">Product Image</th>
                <th class="text-center" scope="col">Product Name</th>
                <th class="text-center" scope="col">Price</th>
                <th class="text-center" scope="col">Quantity</th>
                <th class="text-center" scope="col">Sub Total</th>
                <th class="text-center" scope="col">Checkout</th>
                <th class="text-center" scope="col">Action</th>
            </tr>
        </thead>
        <tbody class="table-row">
        </tbody>
    </table>
    {{-- <div class="card text-bg-light mb-3" style="max-width: 40rem;">
        <div class="card-header text-custome">Process to Checkout</div>
        <div class="card-body">
            <p class="card-text text-custome ">Subtotal: <span class="total_price text-black ms-5"></span></p>
            <div class="text-custome">Shipping:</div>
            <div class="card-header">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                    <label class="form-check-label" for="flexRadioDefault1">
                        Local pickup
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2"
                        checked>
                    <label class="form-check-label" for="flexRadioDefault2">
                        Cash On Delivery
                    </label>
                </div>
               
                <div class="form-check">
                    <input class="form-check-input " type="radio" name="pay_to_online" id="flexRadioDefault3"
                        disabled>
                    <label class="form-check-label" for="flexRadioDefault3">
                        Pay to Online
                    </label>
                </div>
            </div>
            <div>
                <button id="checkout" class="btn btn-outline-white text-white bg-custome w-100 my-3">Checkout</button>
            </div>
        </div>
    </div> --}}
</div>
@include('../user_include/footer/user_footer')


<script>
    $(window).on("load", function() {
        const user_id = "{{ session('login_id') }}";
        var total_price = 0;
        $.ajax({
            url: window.location.origin + '/api/get-user-cart',
            type: 'POST',
            dataType: 'json',
            data: {
                user_id: user_id,
            },
            success: function(data) {
                if (data.status == 200) {
                    for (var i in data.data) {
                        $('.table-row').append(`
                            <tr>
                                <td class="text-center" scope="row"><img src="${data.data[i].products_relation[0].product_image}" height="40px" width="100px"></td>
                                <td class="text-center">${data.data[i].products_relation[0].product_name}</td>
                                <td class="text-center">${data.data[i].products_relation[0].sale_price}</td>
                                <td class="product-edit-field"><input type="number" class="form-control text-center" min="1" value="${data.data[i].qty}"></td>
                                <td class="text-center">${data.data[i].products_relation[0].sale_price*data.data[i].qty}</td>
                                <td class="text-center"><a href="checkout/${data.data[i].products_relation[0].id}" class="btn btn-outline-white text-white bg-custome">Process to checkout</a></td>
                                <td class="text-danger text-center"><i onclick="delete_data('${data.data[i].id}')" class="fa-solid fa-trash"></i></td>
                            </tr>
                      `);
                        total_price = total_price + data.data[i].products_relation[0].sale_price *
                            data.data[i].qty;
                    }
                }
                // $('.total_price').html("Rs: " + total_price);
            }
        })
    });

    $('#checkout').on('click', function() {

    })

    function delete_data(cart_id) {
        $.ajax({
            url: window.location.origin + '/api/delete-user-cart',
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
