@include('../include/sidebar/sidebar')

<h4 class="text-center my-2">Add Your New Product For Sale</h4>

<form id="contact_form" class="mx-5" enctype="multipart/form-data">
    <div class="form-grouup my-2">
        <p class="mb-1">*Product Name</p>
        <input type="text" class="form-control" onkeyup="$('#productNameError').html(' ')" name="Email" placeholder="Product Name">
        <p id="productNameError" class="text-danger"></p>
    </div>
    <div class="form-grouup my-2">
        <p class="mb-1">Choose Your Product Image</p>
        <input type="File" name="product_image">
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-grouup my-2">
                <p class="mb-1">*Regular Price</p>
                <input type="tel" class="form-control" placeholder="Enter your Regular price" name="Regular price">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-grouup my-2">
                <p class="mb-1 ">*Sale Price</p>
                <input type="tel" class="form-control" placeholder="Enter your Sale price" name="Regular price">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-grouup my-2">
                <p class="mb-1">*Inventory</p>
                <input type="tel" class="form-control" placeholder="Enter your Total Number of Stoke" name="Regular price">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-grouup my-2">
                <p class="mb-1 ">*Shipping</p>
                <input type="tel" class="form-control" placeholder="Enter weight of your product" name="Regular price">
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
                        <input class="form-check-input" type="checkbox" value="{{$category->id}}" id="flexCheckDefault{{$category->id}}">
                        <label class="form-check-label" style="display: contents;" for="flexCheckDefault">{{$category->cat_name}}</label>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>

    <div class="form-group my-3">
        <p class="mb-1">*Addition Information</p>
        <textarea class="form-control" placeholder="Fill Advance Information About Your Product" id="floatingTextarea2" rows="5" cols="100"></textarea>
    </div>

    <div class="form-grouup my-2 text-center">
        <button id="submit_form" type="button" class="px-5 border border-white  py-1 rounded-pill bg-custome text-white">Submit</button>
    </div>

</form>
@include('../include/footer/footer')

<script>
    var attr_array = {};
    var attribute = [];
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
            // console.log(attr_array);
        });

        $('#submit_form').click(function() {
            const property_array = Object.values(attr_array);
            const newArr = property_array.map(function(arr_list){
               attribute= attribute.concat(arr_list)
            })
        })
    });
</script>