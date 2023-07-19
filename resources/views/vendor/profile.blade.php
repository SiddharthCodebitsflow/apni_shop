@include('../include/sidebar/sidebar')
<div class="contaienr mt-3">
    <div class="card">
        <div class="card-body profile-detail">

        </div>
    </div>
    <div class="row">
        <div class="text-center mt-4">
            <div class="card">
                <div class="card-header">
                    Your Payment QR Code
                </div>
                <div class="card-body qr-code">
                    {{ QrCode::size(150)->generate("upi://pay?pa={$upi_id[0]->upi}&pn=Siddharth&cu=INR&am=100") }}
                </div>
            </div>
        </div>
    </div>

</div>

@include('../include/footer/footer')

<script>
    $(window).on("load", function() {
        let session_id = "{{ session('user_id') }}";
        $.ajax({
            url: window.location.origin + '/api/profile-details',
            type: 'POST',
            dataType: 'json',
            data: {
                session_id: session_id
            },
            success: function(data) {
                // console.log(data);
                $('.profile-detail').append(` 
                    <div class="row">
                    <div class="col-md-3">
                        <img class="rounded-circle" height="140px" width="140px" src="${data.data.shop_image}" alt="">
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-lg-4 col-6">
                                <label for="">Name</label>
                                <h6>${data.data.name}</h6>
                            </div>
                            <div class="col-lg-4 col-6">
                                <label for="">Email</label>
                                <h6>${data.data.email}</h6>
                            </div>
                            <div class="col-lg-4 col-6">
                                <label for="">Contact Number</label>
                                <h6>${data.data.contact}</h6>
                            </div>
                        </div>
                        <div class="row mt-4">

                            <div class="col-lg-4 col-6">
                                <label for="">Shop id</label>
                                <h6>${data.data.shop_id}</h6>
                            </div>
                            <div class="col-lg-4 col-6">
                                <label for="">UPI Id</label>
                                <h6>${data.data.upi}</h6>
                            </div>
                        </div>
                    </div>
                    </div>

                `);
            }
        });
    });
</script>
