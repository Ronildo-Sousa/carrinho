</div>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<script>
    $(function() {

        var inputs = []

        inputs.push($(".formQtd").children("input"));
        $(inputs[0]).change(function() {
            var quantidade = $(this).val();
            var total = $("#total");
            var totalhidden = 0;
            
            $.each(inputs[0],function (key,value) { 
                var price = $(this).parents(".fromPrice").children("input").val();
                totalhidden += ($(value).val() * price);       
            })
            
            total.text(totalhidden.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' }))
        });

        $(".formCart").submit(function(e) {
            e.preventDefault();

            var form = $(this);
            var id = $(this).children().children("#productId").val();
            var name = $(this).children().children("#productName").val();
            var image = $(this).children().children("#productImage").val();
            var price = $(this).children().children("#productPrice").val();
            var quantidade = $(this).children().children(".form-control").val();

            $.ajax({
                    method: "POST",
                    url: "<?= base_url("/addcart") ?>",
                    data: {
                        quantidade: quantidade,
                        id: id,
                        name: name,
                        image: image,
                        price: price,
                    }
                })
                .done(function(msg) {
                    var btn = form.children().children("button").last();
                    btn.removeClass().addClass("btn btn-success");
                    btn.html("<i class='fas fa-check fa-lg'></i>")
                    btn.on("mouseleave", function() {
                        btn.removeClass().addClass("btn btn-primary");
                        btn.html("<i class='fas fa-cart-plus fa-lg'></i>")
                    })
                });
        });
    });
</script>
</body>

</html>