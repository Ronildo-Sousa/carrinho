<div class="container" style="background-color: #141212; color:white; max-width:800px; padding:25px; border-radius:10px;">
<h3>cadastro</h3>
    <?php if($session->getFlashdata("erro")): ?>
        <div class="alert alert-danger">
        <?= $session->getFlashdata("erro"); ?>
    </div>
    <?php endif; ?>
    <?php if($session->getFlashdata("sucesso")): ?>
        <div class="alert alert-success">
        <?= $session->getFlashdata("sucesso"); ?>
    </div>
    <?php endif; ?>

    <form class="needs-validation" action="<?= base_url("/register"); ?>" method="POST" novalidate>
        <div class="form-group">
            <label for="">Nome</label>
            <input type="text" class="form-control" name="nome" 
            id="validationCustom01" 
    placeholder="Seu nome" required value="<?php if($session->getFlashdata('nome')):?><?= $session->getFlashdata('nome');?><?php endif; ?>">
            <div class="valid-feedback">            
            </div>
            <div class="invalid-feedback">
                Insira um nome!
            </div>
        </div>
        <div class="form-group">
            <label for="">Sobrenome</label>
            <input type="text" class="form-control" name="sobrenome" 
            id="validationCustom01" 
    placeholder="Seu sobrenome" required value="<?php if($session->getFlashdata('sobrenome')):?><?= $session->getFlashdata('sobrenome');?><?php endif; ?>">
            <div class="valid-feedback">            
            </div>
            <div class="invalid-feedback">
                Insira um sobrenome!
            </div>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Endereço de email</label>
            <input type="email" class="form-control" name="email" 
            id="validationCustom01" aria-describedby="emailHelp" 
    placeholder="Seu email" required value="<?php if($session->getFlashdata('email')):?><?= $session->getFlashdata('email');?><?php endif; ?>">
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
        <button type="submit" class="btn btn-primary">Enviar</button>        
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