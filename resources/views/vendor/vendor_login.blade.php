@include('../include/header/header')

<div class="container">
    <div class="col-lg-8 mx-auto my-5">
        <div id="error_login">
        </div>

        <form id="contact_form" enctype="multipart/form-data">
            <div class="card">
                <div class="card-header text-center bg-custome text-white">
                    <h4>Login form</h4>
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
                        <input type="password" id="password" class="form-control" onkeyup="$('#passwordError').html(' ')" name="password" placeholder="Enter the Password">
                        @csrf
                        <p id="passwordError" class="text-danger"></p>
                    </div>

                    <div>
                        <a href="/forget-password" class="d-flex justify-content-end">Forget-password</a>
                    </div>
                    <div class="form-grouup my-2">
                        <!-- <input type="submit" class="form-control rounded-pill bg-custome text-white"> -->
                        <button id="submit_form" type="button" class="form-control rounded-pill bg-custome text-white">Submit</button>
                    </div>
                    <div>
                        <a href="vendor-register" class="form-control text-center text-decoration-none rounded-pill bg-custome text-white">Register</a>
                        <!-- <a href="vendor-register" class="d-flex justify-content-end">Register</a> -->
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

        if (email.length != 0 && shop_id != 0 && password.length != 0) {
            var form = $('#contact_form')[0];
            var formData = new FormData(form);
            $.ajax({
                url: window.location.origin+'/api/vendor-login',
                type: 'POST',
                dataType: 'json',
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.status == 200 && data.user_id != null) {
                        console.log(data);
                        $.ajax({
                            url: window.location.origin + "/session",
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                user_id: data.user_id
                            },
                            success: function(data) {

                                if (data.status == 200) {
                                    window.location = window.location.origin + "/home";
                                } else {
                                    window.location = window.location.origin + "/login";
                                }

                            }
                        });
                    } else if (data.status == 401) {
                        $('#error_login').html('<div class="alert alert-white text-white bg-custome" role="alert">' + data.messages + '</div>');
                        // window.location = window.location.origin + "/vendor/vendor-register";
                    } else if (data.status == 400) {
                        $('#error_login').html('<div class="alert alert-white text-white bg-custome" role="alert">' + data.messages + '</div>');
                    }
                }
            })
        }
    });
</script>