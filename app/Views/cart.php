<div class="container">
    <a href="<?= base_url("/logout"); ?>" class="btn btn-danger my-3">sair</a>
    <a href="<?= base_url("/home"); ?>" class="btn btn-primary">voltar</a><br><br>
    <?php if ($session->getFlashdata("erro")) : ?>
        <p class="alert alert-warning"><?= $session->getFlashdata("erro"); ?></p>
    <?php endif; ?>
    <?php if ($session->getFlashdata("sucesso")) : ?>
        <p class="alert alert-success"><?= $session->getFlashdata("sucesso"); ?></p>
    <?php endif; ?>
    <?php if ($session->getFlashdata("info")) : ?>
        <p class="alert alert-success"><?= $session->getFlashdata("info"); ?></p>
    <?php endif; ?>
</div>
<?php if (isset($productsCart)) : ?>
    <div class="container" style="color: black; background:white; width:100vw; display:flex; justify-content:space-around; padding:25px;">
        <div>
            <?php for ($i = 0; $i < sizeof($productsCart); $i++) : ?>
                <?php $index = array_keys($productsCart)[$i]; ?>
                <div style="width:80%; display:flex; padding:15px; align-items:center; border-bottom: 1px solid gray;">
                    <div style="width: 20%;margin-right:15px">
                        <img src="<?= $productsCart[$index]["product"]["image"]; ?>" style="width: 100%;">
                    </div>
                    <div style="display:flex; flex-direction:column;" class="fromPrice">
                        <h5><?= $productsCart[$index]["product"]["name"] ?></h5>
                        <p class="price">R$<?= number_format($productsCart[$index]["product"]["price"], 2, ",", ""); ?></p>
                        <input type="hidden" name="price" value="<?= $productsCart[$index]["product"]["price"]; ?>">
                        <div class="formQtd" style="display: flex;">
                            <input type="number" class="form-control"  style="width: 35%; margin-right:15px;" value="<?= $productsCart[$index]["quantidade"]; ?>">
                            <form action="<?= base_url("/remove"); ?>" method="POST">
                                <input type="hidden" name="index" value="<?= $index; ?>">
                                <button type="submit" class="btn btn-danger"><i class="far fa-trash-alt fa-lg"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
        <div style="width: 40%; height:35vh; display:flex;flex-direction:column; justify-content:space-between;">
            <h4>Total</h4>
            <h4 id="total">R$ <?= number_format($total, 2, ",", ""); ?></h4>
            <input type="hidden" name="total" id="totalhidden" value="<?= $total ?>">
            <a href="<?= base_url("/done") ?>" class="btn btn-success">Finalizar compra</a>
            <a href="<?= base_url("/home"); ?>" class="btn btn-primary">Continuar comprando</a>
        </div>
    </div>
<?php endif; ?>