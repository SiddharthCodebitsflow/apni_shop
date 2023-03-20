@include('../include/sidebar/sidebar')

<h4 class="text-center my-2">Update your product Attributes</h4>
<div class="row">
    <div class="col-lg-7">
        <form class="mt-5" id="att_form">
            <h6 class="text-center">Edit Product Attributes</h6>
            <div class="form-group">
                <label for="">*Enter the Attributes Name</label>
                <input type="text" id="att_name" onkeyup="$('#att_name_error').html(' ');" name="att_name" placeholder="Edit Atrtributes Name" class="form-control">
                <div id="att_name_error"></div>
            </div>
            <div class="form-group my-3">
                <p class="mb-1">*Edit the Attributes Value</p>
                <textarea class="form-control" name="att_value" onkeyup="$('#att_value_error').html(' ');" id="att_value" placeholder="Edit attribute value" id="floatingTextarea2" rows="5" cols="100"></textarea>
                <div id="att_value_error"></div>
            </div>
            <div class="form-gorup">
                <button id="edit_attiribute" type="button" class="btn sidebar-col text-white">Update Attributes</button>
            </div>
        </form>
    </div>
</div>


@include('../include/footer/footer')

<script>
    $(window).on("load", function() {
        var id = "{{$att_id}}";
        $.ajax({
            url: window.location.origin + '/api/get-single-att',
            type: 'POST',
            dataType: 'JSON',
            data: {
                att_id: id
            },
            success: function(data) {
                $('#att_name').val(data.att_name);
                $('#att_value').val(data.att_value);
            }
        })
    });
    $('#edit_attiribute').click(function() {
        var id = "{{$att_id}}";
        var att_name = $('#att_name').val();
        var att_value = $('#att_value').val();
        if (att_name.length != 0 && att_name.length != 0) {
            $.ajax({
                url: window.location.origin + '/api/att-update',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    att_id: id,
                    att_name: att_name,
                    att_value: att_value
                },
                success: function(data) {
                    if (data.status == 200) {
                        window.location = window.location.origin + '/attributes';
                    } else {
                        alert("your data has not updated please try again");
                    }
                }
            })
        } else {
            if (att_name.length == 0) {
                $('#att_name_error').html('<p class="text-danger">*Attribute name can\'t empty</p>');
            }
            if (att_value.length == 0) {
                $('#att_value_error').html('<p class="text-danger">*Attribute value can\'t empty</p>');
            }
        }
    })
</script>