@include('../include/sidebar/sidebar')

<h4 class="text-center my-2">Update your product Category</h4>
<div class="row">
    <div class="col-lg-7">
        <form class="mt-5" id="att_form">
            <h6 class="text-center">Edit Product Category</h6>
            <div class="form-group">
                <label for="">*Enter the Category Name</label>
                <input type="text" id="cat_name" onkeyup="$('#cat_name_error').html(' ');" name="cat_name" placeholder="Edit category Name" class="form-control">
                <div id="cat_name_error"></div>
            </div>
            <div class="form-group my-3">
                <p class="mb-1">*Edit the Category Value</p>
                <textarea class="form-control" name="cat_descreption" onkeyup="$('#cat_descreption_error').html(' ');" id="cat_descreption" placeholder="Edit category value" id="floatingTextarea2" rows="5" cols="100"></textarea>
                <div id="cat_descreption_error"></div>
            </div>
            <div class="form-gorup">
                <button id="edit_category" type="button" class="btn sidebar-col text-white">Update Category</button>
            </div>
        </form>
    </div>
</div>

@include('../include/footer/footer')


<script>
    $(window).on("load", function() {
        var id = "{{$cat_id}}";
        $.ajax({
            url: window.location.origin + '/api/get-single-category',
            type: 'POST',
            dataType: 'JSON',
            data: {
                cat_id: id
            },
            success: function(data) {
                $('#cat_name').val(data.cat_name);
                $('#cat_descreption').val(data.cat_descreption);
            }
        })
    });

    $('#edit_category').click(function() {
        var id = "{{$cat_id}}";
        var cat_name = $('#cat_name').val();
        var cat_descreption = $('#cat_descreption').val();
        if (cat_name.length != 0 && cat_descreption.length != 0) {
            $.ajax({
                url: window.location.origin + '/api/category-update',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    cat_id: id,
                    cat_name: cat_name,
                    cat_descreption: cat_descreption
                },
                success: function(data) {
                    if (data.status == 200) {
                        window.location = window.location.origin + '/category';
                    } else {
                        alert("your data has not updated please try again");
                    }
                }
            })
        } else {
            if (att_name.length == 0) {
                $('#cat_name_error').html('<p class="text-danger">*Attribute name can\'t empty</p>');
            }
            if (att_value.length == 0) {
                $('#cat_descreption_error').html('<p class="text-danger">*Attribute value can\'t empty</p>');
            }
        }
    })
</script>