<div class="container" style="background-color: #141212; color:white; max-width:500px; padding:25px; border-radius:10px;">
    <h3>Login</h3>
    <?php if ($session->getFlashdata("erro")) : ?>
        <div class="alert alert-danger">
            <?= $session->getFlashdata("erro"); ?>
        </div>
    <?php endif; ?>
    <?php if ($session->getFlashdata("sucesso")) : ?>
        <div class="alert alert-success">
            <?= $session->getFlashdata("sucesso"); ?>
        </div>
    <?php endif; ?>
    <?php if ($session->getFlashdata("info")) : ?>
        <div class="alert alert-info">
            <?= $session->getFlashdata("info"); ?>
        </div>
    <?php endif; ?>

    <form class="needs-validation" action="<?= base_url("/login"); ?>" method="POST" novalidate>
        <div class="form-group">
            <label for="exampleInputEmail1">Endereço de email</label>
            <input type="email" class="form-control" name="email" id="validationCustom01" aria-describedby="emailHelp" placeholder="Seu email" required value="<?php if ($session->getFlashdata('email')) : ?><?= $session->getFlashdata('email'); ?><?php endif; ?>">
            <div class="valid-feedback">

            </div>
            <div class="invalid-feedback">
                Insira um email!
            </div>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Senha</label>
            <input type="password" class="form-control" name="senha" id="exampleInputPassword1" placeholder="Senha" required>

            <div class="invalid-feedback">
                Insira uma senha!
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Logar</button>
        <a href="<?= base_url("/esqueci") ?>" style="margin-left:50%; color:white;">esqueceu a senha</a>
        <a href="<?= base_url("/cadastro"); ?>" style="margin-left:65%; color:white;">cadastre-se</a>
    </form>


    <script>
        // Exemplo de JavaScript inicial para desativar envios de formulário, se houver campos inválidos.
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Pega todos os formulários que nós queremos aplicar estilos de validação Bootstrap personalizados.
                var forms = document.getElementsByClassName('needs-validation');
                // Faz um loop neles e evita o envio
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
</div>