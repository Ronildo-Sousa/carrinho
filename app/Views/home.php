<div class="container my-3">
<a href="<?= base_url("/logout"); ?>" class="btn btn-danger">sair</a>
<a href="<?= base_url("/cart") ?>" class="btn btn-primary">Ver carrinho <i class="fas fa-shopping-cart fa-lg"></i></a>
</div>
<div class="container" style="color: black; display:flex; justify-content:space-around; flex-wrap:wrap; padding:15px;">
<?php if(!empty($products)): ?>
    <?php foreach ($products as $product) : ?>
        <div class="card" style="width: 18rem; margin-top:15px;">
            <img class="card-img-top" src="<?= $product->image; ?>" alt="<?= $product->name; ?>" style="height:25vh">
            <div class="card-body">
                <h5 class="card-title"><?= $product->name; ?></h5>
                <p>R$ <?= number_format($product->price,2,",",""); ?></p>
                <form action="#" name="fromCart" class="formCart" method="POST">
                    <div style="display:flex; justify-content:center; margin-bottom:10px">
                        <input type="hidden" name="productId" id="productId" value="<?= $product->id; ?>">
                        <input type="hidden" name="productName" id="productName" value="<?= $product->name; ?>">
                        <input type="hidden" name="productImage" id="productImage" value="<?= $product->image; ?>">
                        <input type="hidden" name="productPrice" id="productPrice" value="<?= $product->price; ?>">
                        <input type="number" class="form-control" style="width: 30%; margin-right:auto;" value="1">
                        <button  type="submit" class="btn btn-primary" style="width: 20%; display:flex; align-items:center;"><i class="fas fa-cart-plus fa-lg"></i></button>
                    </div>
                </form>
                <form action="<?= base_url("/buy"); ?>" method="POST" name="formBuy">
                    <div style="text-align:center;">
                    <input type="hidden" name="productId" id="productId" value="<?= $product->id; ?>">
                        <input type="hidden" name="productName" id="productName" value="<?= $product->name; ?>">
                        <input type="hidden" name="productImage" id="productImage" value="<?= $product->image; ?>">
                        <input type="hidden" name="productPrice" id="productPrice" value="<?= $product->price; ?>">
                        <button type="submit" class="btn btn-success" style="width: 100%;"><i class="fas fa-check"></i> Comprar</button>
                    </div>
                </form>
            </div>
        </div>
    <?php endforeach; ?>
    <?php else: ?>
        <div class="alert alert-danger">
            Não há produtos para exibir !
        </div>
<?php endif; ?>
</div>

