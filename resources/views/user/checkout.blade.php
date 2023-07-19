@include('../user_include/header/user_header')
<div class="row my-4 overflow-auto">
    <table class="table background">
        <thead>
            <tr>
                <th class="text-center" scope="col">Product Image</th>
                <th class="text-center" scope="col">Product Name</th>
                <th class="text-center" scope="col">Price</th>
                <th class="text-center" scope="col">Quantity</th>
                <th class="text-center" scope="col">Total</th>
                <th class="text-center" scope="col">Confirmation Message</th>
            </tr>
        </thead>
        <tbody class="table-row">
        </tbody>
    </table>
    @include('../user_include/footer/user_footer')

    <script>
        $(window).on("load", function() {
            const user_id = "{{ session('login_id') }}";
            var total_price = 0;
            $.ajax({
                url: window.location.origin + '/api/order-checkout',
                type: 'POST',
                dataType: 'json',
                data: {
                    user_id: user_id,
                },
                success: function(data) {
                    if (data.status == 200) {
                        for (var i in data.data) {
                            if (data.data[i].confirm_status == 0) {
                                $('.table-row').append(`
                                    <tr>
                                        <td class="text-center" scope="row"><img src="${data.data[i].products_relation[0].product_image}" height="40px" width="100px"></td>
                                        <td class="text-center">${data.data[i].products_relation[0].product_name}</td>
                                        <td class="text-center">${data.data[i].products_relation[0].sale_price}</td>
                                        <td class="product-edit-field"><input type="number" class="form-control text-center" min="1" value="${data.data[i].qty}"></td>
                                        <td class="text-center">${data.data[i].products_relation[0].sale_price*data.data[i].qty}</td>
                                        <td class="text-center text-danger">Wait For Order Confiramtion</td>
                                    </tr>
                                `);
                                total_price = total_price + data.data[i].products_relation[0]
                                    .sale_price *
                                    data.data[i].qty;
                            } else if (data.data[i].confirm_status == 1) {
                                $('.table-row').append(`
                                    <tr>
                                        <td class="text-center" scope="row"><img src="${data.data[i].products_relation[0].product_image}" height="40px" width="100px"></td>
                                        <td class="text-center">${data.data[i].products_relation[0].product_name}</td>
                                        <td class="text-center">${data.data[i].products_relation[0].sale_price}</td>
                                        <td class="product-edit-field"><input type="number" class="form-control text-center" min="1" value="${data.data[i].qty}"></td>
                                        <td class="text-center">${data.data[i].products_relation[0].sale_price*data.data[i].qty}</td>
                                        <td class="text-center text-custome">Order has been Confirmed</td></td>
                                    </tr>
                                `);
                                total_price = total_price + data.data[i].products_relation[0]
                                    .sale_price *
                                    data.data[i].qty;
                            } else {
                                $('.table-row').append(`
                                    <tr>
                                        <td class="text-center" scope="row"><img src="${data.data[i].products_relation[0].product_image}" height="40px" width="100px"></td>
                                        <td class="text-center">${data.data[i].products_relation[0].product_name}</td>
                                        <td class="text-center">${data.data[i].products_relation[0].sale_price}</td>
                                        <td class="product-edit-field"><input type="number" class="form-control text-center" min="1" value="${data.data[i].qty}"></td>
                                        <td class="text-center">${data.data[i].products_relation[0].sale_price*data.data[i].qty}</td>
                                        <td class="text-center text-custome">Order has been Rejected</td></td>
                                    </tr>
                                `);
                                total_price = total_price + data.data[i].products_relation[0]
                                    .sale_price *
                                    data.data[i].qty;
                            }
                        }
                    }
                    $('.total_price').html("Rs: " + total_price);
                }
            })
        });
    </script>
