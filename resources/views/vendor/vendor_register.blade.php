@include('../include/header/header')

<div class="container">
    <div class="col-lg-8 mx-auto my-5">
        <form id="contact_form" enctype="multipart/form-data">
            <div class="card">
                <div class="card-header text-center bg-custome text-white">
                    <h4>Registration form</h4>
                </div>
                <div class="card-body">
                    <div class="form-grouup my-2">
                        <input type="text" id="Name" class="form-control" onkeyup="$('#nameError').html(' ')" name="Name" placeholder="Enter the Name">
                        <p id="nameError" class="text-danger"></p>
                    </div>
                    <div class="form-grouup my-2">
                        <input type="email" id=Email class="form-control" onkeyup="$('#emailError').html(' ')" name="Email" placeholder="Enter the Email">
                        <p id="emailError" class="text-danger"></p>
                    </div>
                    <div class="form-grouup my-2">
                        <input type="tel" id="Contact" class="form-control" onkeyup="$('#contactError').html(' ')" name="Contact" placeholder="Enter the Contact Number">
                        <p id="contactError" class="text-danger"></p>
                    </div>
                    <div class="form-grouup my-2">
                        <input type="text" id=Shop_id class="form-control" onkeyup="$('#shop_idError').html(' ')" name="Shop_id" placeholder="Enter the Shop Id">
                        <p id="shop_idError" class="text-danger"></p>
                    </div>
                    <div class="form-grouup my-2">
                        <input type="text" id="Address" class="form-control" onkeyup="$('#addressError').html(' ')" name="Address" placeholder="Enter the Address">
                        <p id="addressError" class="text-danger"></p>
                    </div>
                    <div class="form-grouup my-2">
                        <input type="password" id="password" class="form-control" onkeyup="$('#passwordError').html(' ')" name="password" placeholder="Enter the Password">
                        @csrf
                        <p id="passwordError" class="text-danger"></p>
                    </div>
                    <div class="form-grouup my-2">
                        <label for="">Choose Shop Image</label>
                        <input type="file" id="shop_image" class="form-control" name="shop_image" required>
                    </div>
                   
                    <div class="form-grouup my-2">
                        <!-- <input type="submit" class="form-control rounded-pill bg-custome text-white"> -->
                        <button id="submit_form" type="button" class="form-control rounded-pill bg-custome text-white">Submit</button>
                    </div>
                    <div>
                        <!-- <a href="/login" class="d-flex justify-content-end">Login</a> -->
                        <a href="/login" class="form-control text-center text-decoration-none rounded-pill bg-custome text-white">Login</a>
                    </div>

                </div>

            </div>
        </form>
    </div>
</div>
@include('../include/footer/footer')

<script>
    $('#submit_form').click(function() {

        var name = $('#Name').val();
        var email = $('#Email').val();
        var contact = $('#Contact').val();
        var shop_id = $('#Shop_id').val();
        var address = $('#Address').val();
        var password = $('#password').val();
        if (name.length == 0) {
            $('#nameError').html("*Plese Enter your Name");
        }
        if (contact.length == 0 || contact.length < 10 || contact.length > 10) {
            $('#contactError').html("*Plese Enter your correct mobile number");
        }
        if (email.length == 0) {
            $('#emailError').html("*Please enter your correct email");
        }
        if (shop_id.length == 0) {
            $('#shop_idError').html("*Please enter your correct shop id");
        }
        if (address.length == 0) {
            $('#addressError').html("*Please enter your correct Address");
        }
        if (password.length == 0) {
            $('#passwordError').html("*Please enter the password");
        }

        if (name.length != 0 && contact.length == 10 && password.length != 0 && email.length != 0 && shop_id != 0 && address.length != 0) {
            var form = $('#contact_form')[0];
            var formData = new FormData(form);
            console.log(formData);
            $.ajax({
                url: 'http://<?php echo $_SERVER['HTTP_HOST'] ?>/api/register',
                type: 'POST',
                dataType: 'json',
                data: formData,
                contentType: false,
                processData: false,

                success: function(data) {
                    if (data.status == 200) {
                        window.location = window.location.origin + "/login";
                    } else {
                        window.location = window.location.origin + "/vendor/vendor-register";
                    }
                }
            })
        }
    });
</script>