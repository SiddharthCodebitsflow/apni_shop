@include('user_include/header/user_header1')

<div class="container">
    <div class="col-lg-8 mx-auto my-5">
        <form id="contact_form" enctype="multipart/form-data">
            <div class="card">
                <div class="card-header text-center bg-custome text-white">
                    <h4>Registration form</h4>
                </div>
                <div class="card-body">
                    <div class="form-grouup my-2">
                        <input type="text" id="Name" class="form-control" onkeyup="$('#nameError').html(' ')"
                            name="name" placeholder="Enter the Name">
                        <p id="nameError" class="text-danger"></p>
                    </div>
                    <div class="form-grouup my-2">
                        <input type="email" id=Email class="form-control" onkeyup="$('#emailError').html(' ')"
                            name="email" placeholder="Enter the Email">
                        <p id="emailError" class="text-danger"></p>
                    </div>
                    <div class="form-grouup my-2">
                        <input type="tel" id="Contact" class="form-control" onkeyup="$('#contactError').html(' ')"
                            name="contact" placeholder="Enter the Contact Number">
                        <p id="contactError" class="text-danger"></p>
                    </div>
                    <div class="form-grouup my-2">
                        <input type="password" id="password" class="form-control"
                            onkeyup="$('#passwordError').html(' ')" name="password" placeholder="Enter the Password">
                        @csrf
                        <p id="passwordError" class="text-danger"></p>
                    </div>
                    <div class="form-grouup my-2">
                        <!-- <input type="submit" class="form-control rounded-pill bg-custome text-white"> -->
                        <button id="submit_form" type="button"
                            class="form-control rounded-pill bg-custome text-white">Submit</button>
                    </div>
                    <div>
                        <!-- <a href="/login" class="d-flex justify-content-end">Login</a> -->
                        <a href="/user-login"
                            class="form-control text-center text-decoration-none rounded-pill bg-custome text-white">Login</a>
                    </div>

                </div>

            </div>
        </form>
    </div>
</div>
@include('../user_include/footer/user_footer1')
<script>
    $('#submit_form').on('click', function() {
        var name = $('#Name').val();
        var email = $('#Email').val();
        var contact = $('#Contact').val();
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
        if (password.length == 0) {
            $('#passwordError').html("*Please enter the password");
        }

        if (name.length != 0 && contact.length == 10 && password.length != 0 && email.length != 0) {
            var form = $('#contact_form')[0];
            var formData = new FormData(form);
            console.log(formData);
            $.ajax({
                url: window.location.origin + '/api/user-register',
                type: 'POST',
                dataType: 'json',
                data: formData,
                contentType: false,
                processData: false,

                success: function(data) {
                    console.log(data);
                    if (data.status == 200) {
                        window.location = window.location.origin + "/user-login";
                    } else {
                        window.location = window.location.origin + "/user-register";
                    }
                }
            })
        }
    });
</script>
