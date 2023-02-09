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
        <p class="mb-1">*Select Attributes</p>
        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
        <label class="form-check-label" for="flexCheckDefault">Male</label>
        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
        <label class="form-check-label" for="flexCheckDefault">Female</label>
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