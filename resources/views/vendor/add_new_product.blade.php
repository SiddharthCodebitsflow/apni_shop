@include('../include/sidebar/sidebar')

<h4 class="text-center my-2">Add Your New Product For Sale</h4>

<form id="product_form" class="mx-5" enctype="multipart/form-data">
    <div class="form-grouup my-2">
        <p class="mb-1">*Product Name</p>
        <input type="text" id="productName" class="form-control" onkeyup="$('#productNameError').html(' ')" name="product_name" placeholder="Product Name">
        <p id="productNameError" class="text-danger"></p>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-grouup my-2">
                <p class="mb-1">Choose Your Product Image</p>
                <input type="File" id="file" name="product_image">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-grouup my-2">
                <p class="mb-1">*Vendor price</p>
                <input type="tel" id="vendor_price" class="form-control" placeholder="Enter Vendor price" name="vendor_price">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-grouup my-2">
                <p class="mb-1">*Regular Price</p>
                <input type="tel" id="regular_price" class="form-control" placeholder="Enter your Regular price" name="regular_price">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-grouup my-2">
                <p class="mb-1 ">*Sale Price</p>
                <input type="tel" class="form-control" id="sale_price" placeholder="Enter your Sale price" name="sale_price">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-grouup my-2">
                <p class="mb-1">*Inventory</p>
                <input type="tel" class="form-control" id="inventory" placeholder="Enter your Total Number of Stoke" name="inventory">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-grouup my-2">
                <p class="mb-1 ">*Shipping</p>
                <input type="tel" class="form-control" id="shipping" placeholder="Enter weight of your product" name="shipping">
            </div>
        </div>
    </div>
    <div class="form-grouup my-2">

        <div class="row">
            <div class="col-lg-6">
                <p class="mb-1">*Select Attributes</p>
                <div class="row">
                    @foreach ($attribute as $attribute)
                    <div class="col-lg-5 mt-2 d-flex checkbox-block">
                        <input class="form-check-input selected-option" type="checkbox" value="{{$attribute->id}}" id="checkbox{{$attribute->id}}">
                        <label class="form-check-label" for="checkbox">{{$attribute->attribute_name}}</label>
                    </div>
                    <div class="modal" id="exampleModal{{$attribute->id}}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">{{$attribute->attribute_name}}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        @foreach(explode(',', $attribute->attribute_value) as $key=> $att_value)
                                        <div class="col-lg-5 checkbox-block d-flex">
                                            <input class="form-check-input selected-checkbox{{$attribute->id}}" type="checkbox" value="{{$att_value}}" id="select-checkbox{{$key}}{{$attribute->id}}">
                                            <label class="form-check-label" for="checkbox">{{$att_value}}</label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn bg-custome text-white" data-bs-dismiss="modal">Ok</button>
                                    <!-- <button type="button" class="btn bg-custome text-white save-data{{$attribute->id}}">Save changes</button> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="select-value"></div>
            </div>

            <div class="col-lg-6">
                <p class="mb-1">*Select Category</p>
                <div class="row">
                    @foreach ($category as $category)
                    <div class="col-lg-5 mt-2 d-flex checkbox-block">
                        <input class="form-check-input select-cat" type="checkbox" value="{{$category->cat_name}}" id="{{$category->id}}">
                        <label class="form-check-label" style="display: contents;" for="flexCheckDefault">{{$category->cat_name}}</label>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>

    <div class="form-group my-3">
        <p class="mb-1">*Addition Information</p>
        <textarea class="form-control" name="addition_info" id="addition_info" placeholder="Fill Advance Information About Your Product" id="floatingTextarea2" rows="5" cols="100"></textarea>
    </div>

    <div class="form-grouup my-2 text-center">
        <button id="submit_form" type="button" class="px-5 border border-white  py-1 rounded-pill bg-custome text-white">Submit</button>
    </div>

</form>


<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="att_title">Add Product Status</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modal_image" src="" height="50%" width="50%" he alt="Not Found">
                <h1 class="modal-title fs-5 text-custome" id="product_error"></h1>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="refresh_windows()" class="btn bg-custome text-white" data-bs-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>
@include('../include/footer/footer')

<script>
    var attr_array = {};
    var attribute = [];
    var category = [];
    var category_id = [];
    $(document).ready(function() {
        $('.selected-option').change(function() {
            var id = jQuery(this).val();
            if ($(this).is(":checked")) {
                let temp_arr = [];
                $('#exampleModal' + id).modal('show');
                $('.selected-checkbox' + id).prop('checked', false);
                $('.selected-checkbox' + id).change(function() {
                    if ($(this).is(":checked")) {
                        let checkbox_id = $(this).attr('id');
                        let attr = $('#' + checkbox_id).val();
                        index = temp_arr.indexOf(attr);
                        if (index == -1) {
                            temp_arr.push(attr);
                        }
                    } else {
                        let checkbox_id1 = $(this).attr('id');
                        index = temp_arr.indexOf($('#' + checkbox_id1).val())
                        if (index > -1) {
                            temp_arr.splice(index, 1);
                        }
                    }
                    attr_array['title' + id] = temp_arr;
                });
            } else {
                $('.selected-checkbox' + id).prop('checked', false);
                delete attr_array['title' + id];
            }
        });

        $('.select-cat').change(function() {
            let cat_value = jQuery(this).val();
            let cat_id = $(this).attr('id');
            if ($(this).is(":checked")) {
                index = category.indexOf(cat_value);
                cat_index = category_id.indexOf(cat_id);
                if (index == -1) {
                    category.push(cat_value);
                    category_id.push(cat_id);
                }
            } else {
                index = category.indexOf(cat_value);
                cat_index = category_id.indexOf(cat_id);
                if (index > -1) {
                    category.splice(index, 1);
                    category_id.splice(cat_index, 1);
                }
            }
        });

        $('#submit_form').click(function() {
            const property_array = Object.values(attr_array);
            const newArr = property_array.map(function(arr_list) {
                attribute = attribute.concat(arr_list);
            });
            category_id=category_id.toString();
            category = category.toString();
            attribute = attribute.toString();
            let form = $('#product_form')[0];
            var formData = new FormData(form);
            let product_name = $('#productName').val();
            let regular_price = $('#regular_price').val();
            let sale_price = $('#sale_price').val();
            let inventory = $('#inventory').val();
            let shipping = $('#shipping').val();
            let addition_info = $('#addition_info').val();
            let session = "{{session('user_id')}}";
            formData.append("session", session);
            formData.append("category", category);
            formData.append("attribute", attribute);
            formData.append("category_id",category_id);
            $.ajax({
                url: window.location.origin + '/api/add-new-product',
                type: 'POST',
                dataType: 'json',
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.status == 200) {
                        $("#modal_image").attr("src", "/web_image/right.png");
                        $("#product_error").html(data.message);
                        $("#staticBackdrop").modal('show');
                    } else {
                        $("#modal_image").attr("src", "/web_image/wrong.jpeg");
                        $("#product_error").html(data.message);
                        $("#staticBackdrop").modal('show');
                    }
                }
            });

        })
    });

    function refresh_windows() {
        location.reload();
    }
</script>