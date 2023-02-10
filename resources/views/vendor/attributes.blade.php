@include('../include/sidebar/sidebar')

<h4 class="text-center my-2">Add your product Attributes</h4>
<div class="row">
    <div class="col-lg-5">
        <form class="mt-5" id="att_form">
            <h6 class="text-center">Add Product Attributes</h6>
            <div class="form-group">
                <label for="">*Enter the Attributes Name</label>
                <input type="text" id="att_name" onkeyup="$('#att_name_error').html(' ');" name="att_name" placeholder="Atrtributes Name" class="form-control">
                <div id="att_name_error"></div>
            </div>
            <div class="form-group my-3">
                <p class="mb-1">*Enter the Attributes Value</p>
                <textarea class="form-control" name="att_value" onkeyup="$('#att_value_error').html(' ');" id="att_value" placeholder="Fill value and seprated by | sign  e.g => green|black|blue " id="floatingTextarea2" rows="5" cols="100"></textarea>
                <div id="att_value_error"></div>
            </div>
            <div class="form-gorup">
                <button id="add_attiribute" type="button" class="btn sidebar-col text-white">Add Attributes</button>
            </div>
        </form>
    </div>
    <div class="col-lg-7">
        <h6 class="text-center mt-5">Attributes List</h6>
        <table class="table table-hover ">
            <tr class="text-center table_row">
                <th>Attribute name</th>
                <th>Attribute value</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <tr class="text-center">
                <td id="tbl_name">T-shirt</td>
                <td id="tbl_value">Green,Red,Blue,White,yellow</td>
                <td id="tbl_value"><button value="1">Edit</button></td>
                <td id="tbl_value"><button value="1">Delete</button></td>
            </tr>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="att_title">Attribute Status</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modal_image" src="" height="50%" width="50%" he alt="Not Found">
                <h1 class="modal-title fs-5 text-custome" id="att_error"></h1>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-custome text-white" data-bs-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>

@include('../include/footer/footer')

<script>
    $("#add_attiribute").click(function() {
        var form = $('#att_form')[0];
        var formData = new FormData(form);
        var att_name = $('#att_name').val();
        var att_value = $('#att_value').val();
        formData.append('session', "{{session('user_id')}}");
        if (att_name.length != 0 && att_value.length != 0) {
            $.ajax({
                url: window.location.origin + '/api/attribute',
                type: 'POST',
                dataType: 'json',
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.status == 200) {
                        $("#modal_image").attr("src", "/web_image/right.png");
                        $("#att_error").html(data.messages);
                        $("#staticBackdrop").modal('show');
                        $(".table_row").after('<tr class="text-center"><td>' + data.att_name + '</td><td>' + data.att_value + '</td> ><td><a class="btn sidebar-col text-white" href="update-attribute/' + data.att_id + '">Edit</a></td></td><td><button class="btn sidebar-col text-white" onclick="delete_att(' + data.att_id + ')" id="delete" value="' + data.att_id + '">Delete</button></td>  </tr>');
                        $('#att_name').val('');
                        $('#att_value').val('');
                    } else {
                        $("#modal_image").attr("src", "/web_image/wrong.jpeg");
                        $("#att_error").html(data.messages);
                        $("#staticBackdrop").modal('show');
                        $('#att_name').val('');
                        $('#att_value').val('');
                    }
                }
            })
        } else {
            if (att_name.length == 0) {
                $('#att_name_error').html('<p class="text-danger">*Field is required</p>');
            }
            if (att_value.length == 0) {
                $('#att_value_error').html('<p class="text-danger">*Field is required</p>');
            }
        }
    })

    $(window).on("load", function() {
        var user_id = "{{session('user_id')}}";
        var user_form = {
            user_id: user_id
        };
        console.log(user_form);
        $.ajax({
            url: window.location.origin + '/api/get-attribute',
            type: 'POST',
            dataType: 'json',
            data: user_form,
            success: function(data) {
                console.log(data.data);
                if (data.status == 200) {
                    for (var i in data.data) {
                        $(".table_row").after('<tr class="text-center"><td>' + data.data[i].attribute_name + '</td><td>' + data.data[i].attribute_value + '</td><td><a class="btn sidebar-col text-white" href="update-attribute/' + data.data[i].id + '">Edit</a></td><td><button class="btn sidebar-col text-white" onclick="delete_att(' + data.data[i].id + ')" id="delete" value="' + data.data[i].id + '">Delete</button></td> </tr></tr>');
                    }
                }
            }
        })
    });

    function delete_att(id) {
        $.ajax({
            url: window.location.origin + '/api/delete-att',
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