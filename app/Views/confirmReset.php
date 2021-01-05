<div class="container" style="background-color: #141212; color:white; max-width:600px; padding:25px; border-radius:10px;">
    <h3>Confirme que é voçê</h3>
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
    <?php if($session->getFlashdata("info")): ?>
        <div class="alert alert-info">
        <?= $session->getFlashdata("info"); ?>
    </div>
    <?php endif; ?>
    
    <form class="needs-validation" action="<?= base_url("/reset"); ?>" method="POST" novalidate>
        <div class="form-group">
            <label for="exampleInputEmail1">Codigo para redefinir</label>
            <input type="text" class="form-control" name="token" 
            id="validationCustom01" 
    placeholder="Seu código" required >
            <div class="valid-feedback">
                
            </div>
            <div class="invalid-feedback">
                Insira um código!
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