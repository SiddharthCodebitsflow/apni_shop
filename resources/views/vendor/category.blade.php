@include('../include/sidebar/sidebar')
<h4 class="text-center my-2">Add category</h4>
<div class="row">
    <div class="col-lg-5">
        <form class="mt-5" id="att_form">
            <h6 class="text-center">Add category</h6>
            <div class="form-group">
                <label for="">*Enter the category Name</label>
                <input type="text" id="cat_name" onkeyup="$('#cat_name_error').html(' ');" name="att_name" placeholder="Enter the category Name" class="form-control">
                <div id="cat_name_error"></div>
            </div>
            <div class="form-group my-3">
                <p class="mb-1">*Enter the category Decreption</p>
                <textarea class="form-control" name="cat_descreption" onkeyup="$('#cat_descreption_error').html(' ');" id="cat_descreption" placeholder="Enter the category Decreption" id="floatingTextarea2" rows="5" cols="100"></textarea>
                <div id="cat_descreption_error"></div>
            </div>
            <div class="form-gorup">
                <button id="add_category" type="button" class="btn sidebar-col text-white">Add category</button>
            </div>
        </form>
    </div>
    <div class="col-lg-7">
        <h6 class="text-center mt-5">category List</h6>
        <table class="table table-hover ">
            <tr class="text-center table_row">
                <th>category Name</th>
                <th>category descreption</th>
                <th>count</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <!-- <tr class="text-center">
                <td id="tbl_name">T-shirt</td>
                <td id="tbl_value">Green,Red,Blue,White,yellow</td>
                <td id="tbl_value"><button value="1">Edit</button></td>
                <td id="tbl_value"><button value="1">Delete</button></td>
            </tr> -->
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="att_title">Category Status</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modal_image" src="" height="50%" width="50%" he alt="Not Found">
                <h1 class="modal-title fs-5 text-custome" id="cat_error"></h1>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-custome text-white" data-bs-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>

@include('../include/footer/footer')

<script>
    $('#add_category').click(function() {
        var name = $('#cat_name').val();
        var descreption = $('#cat_descreption').val();
        var session = "{{session('user_id')}}";
        if (name.length != 0 && descreption.length != 0) {
            $.ajax({
                url: window.location.origin + '/api/add-category',
                type: 'POST',
                dataType: 'json',
                data: {
                    cat_name: name,
                    cat_descreption: descreption,
                    session: session
                },
                success: function(data) {
                    if (data.status == 200) {
                        $("#modal_image").attr("src", "/web_image/right.png");
                        $("#cat_error").html(data.message);
                        $("#staticBackdrop").modal('show');
                        $(".table_row").after('<tr class="text-center"><td>' + data.cat_name + '</td><td>' + data.cat_descreption + '</td> ><td><a href="">0</a></td><td><a class="btn sidebar-col text-white" href="update-category/' + data.cat_id + '">Edit</a></td></td><td><button class="btn sidebar-col text-white" onclick="delete_att(' + data.cat_id + ')" id="delete" value="' + data.cat_id + '">Delete</button></td>  </tr>');
                        $('#cat_name').val('');
                        $('#cat_descreption').val('');
                    } else {
                        $("#modal_image").attr("src", "/web_image/wrong.jpeg");
                        $("#cat_error").html(data.message);
                        $("#staticBackdrop").modal('show');
                        $('#cat_name').val('');
                        $('#cat_descreption').val('');
                    }
                }
            })
        } else {
            if (name.length == 0) {
                $('#cat_name_error').html('<p class="text-danger">*Field is required</p>')
            }
            if (descreption.length == 0) {
                $('#cat_descreption_error').html('<p class="text-danger">*Field is required</p>')
            }
        }
    })

    $(window).on("load", function() {
        var user_id = "{{session('user_id')}}";
        var user_form = {
            session: user_id
        };
        $.ajax({
            url: window.location.origin + '/api/get-category',
            type: 'POST',
            dataType: 'json',
            data: user_form,
            success: function(data) {
                if (data.status == 200) {
                    for (var i in data.data) {
                        $(".table_row").after('<tr class="text-center"><td>' + data.data[i].cat_name + '</td><td>' + data.data[i].cat_descreption + '</td><td><a href="">'+data.data[i].relationship_count+'</a></td><td><a class="btn sidebar-col text-white" href="update-category/' + data.data[i].id + '">Edit</a></td><td><button class="btn sidebar-col text-white" onclick="delete_att(' + data.data[i].id + ')" id="delete" value="' + data.data[i].id + '">Delete</button></td> </tr></tr>');
                    }
                }
            }
        })
    });

    function delete_att(id) {
        $.ajax({
            url: window.location.origin + '/api/delete-cat',
            type: 'POST',
            dataType: 'json',
            data: {
                att_id: id
            },
            success: function(data) {
                location.reload();
            }
        })
    }
</script>