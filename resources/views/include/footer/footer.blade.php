</div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
    $(window).on("load", function() {
        var session_id = "{{session('user_id')}}";
        $.ajax({
            url: window.location.origin + '/api/vendor-cart',
            type: 'POST',
            dataType: 'json',
            data: {
                session: session_id
            },
            success: function(data) {
                if (data.status == 200) {
                    $('.card-badge').append(data.count);
                } else {

                }
            }
        })
    });
</script>
</body>

</html>