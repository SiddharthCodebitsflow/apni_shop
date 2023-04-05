@include('../user_include/header/user_header1')

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
                        <input type="email" id=Email class="form-control" onkeyup="$('#emailError').html(' ')"
                            name="email" placeholder="Enter the Email">
                        <p id="emailError" class="text-danger"></p>
                    </div>

                    <div class="form-grouup my-2">
                        <input type="password" id="password" class="form-control"
                            onkeyup="$('#passwordError').html(' ')" name="password" placeholder="Enter the Password">
                        @csrf
                        <p id="passwordError" class="text-danger"></p>
                    </div>

                    <div>
                        <a href="#" class="d-flex justify-content-end">Forget-password</a>
                    </div>
                    <div class="form-grouup my-2">
                        <!-- <input type="submit" class="form-control rounded-pill bg-custome text-white"> -->
                        <button id="submit_form" type="button"
                            class="form-control rounded-pill bg-custome text-white">Submit</button>
                    </div>
                    <div>
                        <a href="user-register"
                            class="form-control text-center text-decoration-none rounded-pill bg-custome text-white">Register</a>
                        <!-- <a href="vendor-register" class="d-flex justify-content-end">Register</a> -->
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@include('../user_include/footer/user_footer1')


<script>
    $('#submit_form').click(function() {
        var email = $('#Email').val();
        var password = $('#password').val();


        if (email.length == 0) {
            $('#emailError').html("*Please enter your correct email");
        }
        if (password.length == 0) {
            $('#passwordError').html("*Please enter the password");
        }

        if (email.length != 0 && password.length != 0) {
            var form = $('#contact_form')[0];
            var formData = new FormData(form);
            $.ajax({
                url: window.location.origin + '/api/user-login',
                type: 'POST',
                dataType: 'json',
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.status == 200 && data.id != null) {
                        console.log(data.id);
                        $.ajax({
                            url: window.location.origin + "/user-session",
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                user_id: data.id
                            },
                            success: function(data) {

                                if (data.status == 200) {
                                    window.location = window.location.origin + "/user-home";
                                } else {
                                    window.location = window.location.origin + "/user-login";
                                }

                            }
                        });
                    } else if (data.status == 401) {
                        $('#error_login').html(
                            '<div class="alert alert-white text-white bg-custome" role="alert">' +
                            data.messages + '</div>');
                        // window.location = window.location.origin + "/vendor/vendor-register";
                    } else if (data.status == 400) {
                        $('#error_login').html(
                            '<div class="alert alert-white text-white bg-custome" role="alert">' +
                            data.messages + '</div>');
                    }
                }
            })
        }
    });
</script>
