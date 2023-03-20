@include('../include/header/header')

<div class="container">
    <div class="col-lg-8 mx-auto my-5">
        <div id="error_login">
        </div>

        <form id="contact_form" enctype="multipart/form-data">
            <div class="card">
                <div class="card-header text-center bg-custome text-white">
                    <h4>Forget Password</h4>
                </div>
                <div class="card-body">
                    <div class="form-grouup my-2">
                        <input type="email" id=Email class="form-control" onkeyup="$('#emailError').html(' ')" name="Email" placeholder="Enter the Email">
                        <p id="emailError" class="text-danger"></p>
                    </div>

                    <div class="form-grouup my-2">
                        <input type="text" id=Shop_id class="form-control" onkeyup="$('#shop_idError').html(' ')" name="Shop_id" placeholder="Enter the Shop Id">
                        <p id="shop_idError" class="text-danger"></p>
                    </div>

                    <div class="form-grouup my-2">
                        <input type="tel" id="Contact" class="form-control" onkeyup="$('#contactError').html(' ')" name="Contact" placeholder="Enter the Contact Number">
                        <p id="contactError" class="text-danger"></p>
                    </div>

                    <div class="form-grouup my-2">
                        <input type="password" id="password" class="form-control" onkeyup="$('#passwordError').html(' ')" name="password" placeholder="Enter the New Password">
                        @csrf
                        <p id="passwordError" class="text-danger"></p>
                    </div>
                    <div class="form-grouup my-2">
                        <button id="submit_form" type="button" class="form-control rounded-pill bg-custome text-white">Submit</button>
                    </div>
                    <div>
                        <a href="login" class="form-control text-center text-decoration-none rounded-pill bg-custome text-white">Go to Login</a>
                    </div>

                </div>

            </div>
        </form>
    </div>
</div>
@include('../include/footer/footer')



<script>
    $('#submit_form').click(function() {
        var email = $('#Email').val();
        var shop_id = $('#Shop_id').val();
        var contact = $('#Contact').val();
        var password = $('#password').val();


        if (email.length == 0) {
            $('#emailError').html("*Please enter your correct email");
        }
        if (shop_id.length == 0) {
            $('#shop_idError').html("*Please enter your correct shop id");
        }
        if (password.length == 0) {
            $('#passwordError').html("*Please enter the password");
        }
        if (contact.length == 0 || contact.length < 10 || contact.length > 10) {
            $('#contactError').html("*Plese Enter your correct mobile number");
        }

        if (email.length != 0 && contact.length == 10 && shop_id != 0 && password.length != 0) {
            var form = $('#contact_form')[0];
            var formData = new FormData(form);
            $.ajax({
                url: 'http://<?php echo $_SERVER['HTTP_HOST'] ?>/api/forget-password',
                type: 'POST',
                dataType: 'json',
                data: formData,
                contentType: false,
                processData: false,

                success: function(data) {
                    if (data.status == 200) {
                        $('#error_login').html('<div class="alert alert-white text-white bg-custome" role="alert">' + data.message + '</div>');
                    } else if (data.status == 401) {
                        $('#error_login').html('<div class="alert alert-white text-white bg-custome" role="alert">' + data.message + '</div>');
                        // window.location = window.location.origin + "/vendor/vendor-register";
                    } else if (data.status == 400) {
                        $('#error_login').html('<div class="alert alert-white text-white bg-custome" role="alert">' + data.message + '</div>');
                    }
                }
            })
        }
    });
</script>