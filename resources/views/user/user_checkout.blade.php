@include('../user_include/header/user_header')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8">
            <div class="card my-3">
                <div class="card-header">
                    <h3 class="text-custome text-center">Details for Delivery</h3>
                </div>
                <div class="card-body">
                    <form action="">
                        <div class="form-goup mt-3">
                            <input type="text" class="form-control" id="name"
                                onkeyup="$('#nameerror').html(' ');" class="name" placeholder="Enter the Name">
                            <p id="nameerror" class="text-danger"></p>
                        </div>
                        <div class="form-goup mt-3">
                            <input type="email" class="form-control" id="email"
                                onkeyup="$('#emailerror').html(' ');" class="email" placeholder="Enter the Email">
                            <p id="emailerror" class="text-danger"></p>
                        </div>
                        <div class="form-goup mt-3">
                            <input type="tel" class="form-control" id="contact"
                                onkeyup="$('#contacterror').html(' ');" class="contact"
                                placeholder="Enter the contact number">
                            <p id="contacterror" class="text-danger"></p>
                        </div>
                        <div class="form-goup mt-3">
                            <input type="text" class="form-control" id="address"
                                onkeyup="$('#addresserror').html(' ');" name="address" placeholder="Enter the Address">
                            <p id="addresserror" class="text-danger"></p>
                        </div>
                        <div class="form-goup mt-3">
                            <input type="text" class="form-control" id="postcode"
                                onkeyup="$('#postcodeerror').html(' ');" name="postcode" placeholder="postcode">
                            <p id="postcodeerror" class="text-danger"></p>
                        </div>
                        <div class="form-goup mt-3">
                            <input type="text" class="form-control" id="country"
                                onkeyup="$('#countryerror').html(' ');" name="country" placeholder="country">
                            <p id="countryerror" class="text-danger"></p>
                        </div>
                        <div class="form-goup mt-3">
                            <textarea class="form-control" name="custome_field" onkeyup="$('#custome_fielderror').html(' ');" id="custome_field"
                                placeholder="Addition field for Customizeation your producat"></textarea>
                            <p id="custome_fielderror" class="text-danger"></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card text-bg-light mb-3 mt-5" style="max-width: 40rem;">
                <div class="card-header text-custome">Process to Checkout</div>
                <div class="card-body">
                    <p class="card-text text-custome ">Total Rs: <span class="total_price h5 ms-5"></span></p>
                    <p class="card-text text-custome ">Quantity: <span class="qty h5 ms-5"></span></p>
                    <div class="text-custome">Shipping:</div>
                    <div class="card-header">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="local-pick" id="local-pickup" disabled>
                            <label class="form-check-label" for="flexRadioDefault1">
                                Local pickup
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="cash-on-delevery"
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
                        <button id="checkout"
                            class="btn btn-outline-white text-white bg-custome w-100 my-3">Checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('../user_include/footer/user_footer')

<script>
    $(window).on("load", function() {
        let product_id = "{{ $product_id }}";
        $.ajax({
            url: window.location.origin + '/api/get-single-user-product',
            type: 'POST',
            dataType: 'json',
            data: {
                product_id: product_id
            },
            success: function(data) {
                if (data.status == 200) {
                    total_price = data.data[0].sale_price * data.data[0].user_relationship[0].qty;
                    quantity = data.data[0].user_relationship[0].qty;
                    $('.total_price').html(total_price);
                    $('.qty').html(quantity);
                }
            }
        })
    });
    $('#checkout').on('click', function() {
        let name = $('#name').val();
        let email = $('#email').val();
        let contact = $('#contact').val();
        let address = $('#address').val();
        let postcode = $('#postcode').val();
        let country = $('#country').val();
        let custome_field = $('#custome_field').val();
        let total_price = $('.total_price').html();
        let product_id = "{{ $product_id }}";
        let user_id = "{{ session('login_id') }}";
        let quantity = $('.qty').html();

        if ($("#cash-on-delevery").prop('checked') == true) {
            payment_type = 1; // Cash on delevery
        } else if ($('#local-pick').prop('checked') == true) {
            payment_type = 0;
        }
        if (name.length == 0) {
            $('#nameerror').html("* Name is required")
        }
        if (email.length == 0) {
            $('#emailerror').html("* Email is required")
        }
        if (contact.length == 0) {
            $('#contacterror').html("* contact is required")
        }
        if (postcode.length == 0) {
            $('#postcodeerror').html("* Postcode is required")
        }
        if (address.length == 0) {
            $('#addresserror').html("* Address is required")
        }
        if (country.length == 0) {
            $('#countryerror').html("* Address is required")
        }
        if (custome_field.length == 0) {
            $('#custome_fielderror').html("* Addition Information is required")
        }

        if (name.length != 0 && email.length != 0 && contact.length != 0 && postcode.length != 0 && address
            .length != 0 && country.length != 0 && custome_field.length != 0) {
            let product_id = "{{ $product_id }}";
            $.ajax({
                url: window.location.origin + '/api/user-order',
                type: 'POST',
                dataType: 'json',
                data: {
                    product_id: product_id,
                    name: name,
                    email: email,
                    contact: contact,
                    address: address,
                    postcode: postcode,
                    country: country,
                    addition_information: custome_field,
                    total_price: total_price,
                    user_id: user_id,
                    qty: quantity,
                    payment_type: payment_type
                },
                success: function(data) {
                    if (data.status == 200) {
                        window.location = window.location.origin + "/order-checkout";
                    }
                }
            })
        }
    })
</script>
