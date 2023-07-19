@include('../include/sidebar/sidebar')
<div class="row my-4 overflow-auto">
    <table class="table background">
        <thead>
            <tr>
                <th class="text-center" scope="col">Product</th>
                <th class="text-center" scope="col">Customer Name</th>
                <th class="text-center" scope="col">Address</th>
                <th class="text-center" scope="col">Contact</th>
                <th class="text-center" scope="col">Quantity</th>
                <th class="text-center" scope="col">Addition Information</th>
                <th class="text-center" scope="col">Action</th>
                </th>
            </tr>
        </thead>
        <tbody class="table-row">
        </tbody>
    </table>
</div>
@include('../include/footer/footer')

<script>
    $(window).on("load", function() {
        const user_id = "{{ session('user_id') }}";
        var total_price = 0;
        $.ajax({
            url: window.location.origin + '/api/get-order',
            type: 'POST',
            dataType: 'json',
            success: function(data) {
                console.log(data);
                if (data.status == 200) {
                    for (var i in data.data) {
                        if (data.data[i].products_relation[0].vendor_id == user_id) {
                            if (data.data[i].confirm_status == 0) {
                                $('.table-row').append(`
                                <tr>
                                    <td class="text-center" scope="row"><a href="/about-product/${data.data[i].products_relation[0].id}">${data.data[i].products_relation[0].product_name}</a></td>
                                    <td class="text-center">${data.data[i].name}</td>
                                    <td class="product-edit-field">${data.data[i].address+" , "+data.data[i].postcode}</td>
                                    <td class="text-center">${data.data[i].contact}</td>
                                    <td class="text-center">${data.data[i].qty}</td>
                                    <td class="text-center">${data.data[i].addition_information}</td>
                                    <td class="text-center text-danger"><button onclick="accept_order(${data.data[i].id})" class="btn me-md-1 mt-1 bg-custome text-white">Accept</button><button onclick="reject_order(${data.data[i].id})" class="btn bg-danger ms-md-1 mt-1 text-white">Reject</button></td>
                                </tr>
                            `);
                            } else if (data.data[i].confirm_status == 1) {
                                $('.table-row').append(`
                                <tr>
                                    <td class="text-center" scope="row"><a href="/about-product/${data.data[i].products_relation[0].id}">${data.data[i].products_relation[0].product_name}</a></td>
                                    <td class="text-center">${data.data[i].name}</td>
                                    <td class="product-edit-field">${data.data[i].address+" , "+data.data[i].postcode}</td>
                                    <td class="text-center">${data.data[i].contact}</td>
                                    <td class="text-center">${data.data[i].qty}</td>
                                    <td class="text-center">${data.data[i].addition_information}</td>
                                    <td class="text-center text-custome">Accepted</td>
                                </tr>
                            `);
                            } else {
                                $('.table-row').append(`
                                <tr>
                                    <td class="text-center" scope="row"><a href="/about-product/${data.data[i].products_relation[0].id}">${data.data[i].products_relation[0].product_name}</a></td>
                                    <td class="text-center">${data.data[i].name}</td>
                                    <td class="product-edit-field">${data.data[i].address+" , "+data.data[i].postcode}</td>
                                    <td class="text-center">${data.data[i].contact}</td>
                                    <td class="text-center">${data.data[i].qty}</td>
                                    <td class="text-center">${data.data[i].addition_information}</td>
                                    <td class="text-center text-danger">Rejected</td>
                                </tr>
                            `);
                            }
                        }
                    }
                }
            }
        })
    });

    function accept_order(order_id) {

        $.ajax({
            url: window.location.origin + '/api/accept-order',
            type: 'POST',
            dataType: 'json',
            data: {
                order_id: order_id
            },
            success: function(data) {
                if (data.status == 200) {
                    location.reload();
                }
            }
        });
    }
    function reject_order(order_id) {

        $.ajax({
            url: window.location.origin + '/api/reject-order',
            type: 'POST',
            dataType: 'json',
            data: {
                order_id: order_id
            },
            success: function(data) {
                if (data.status == 200) {
                    location.reload();
                }
            }
        });
    }
</script>
