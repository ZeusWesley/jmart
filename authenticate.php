<style>
    .w-100 {
        width: 100% !important;
    }
</style>

<h3>Informe os dados abaixo para continuar.</h3>
<form action="<?php echo site_url(). '/wp-json/jmart/signup'?>" id="jmart_signup_form">
    <div class="form-group">
        <input type="text" class="w-100" name="name" placeholder="Nome" required>
    </div>

    <div class="form-group">
        <input type="email" class="w-100" name="email" placeholder="E-mail" required>
    </div>

    <div class="form-group">
        <input type="password" class="w-100" name="password" placeholder="Senha" required>
    </div>

    <div class="form-group">
        <input type="password" class="w-100" name="confirm_password" placeholder="Confirmação de senha" style="margin-bottom: 5px" required>
        <small class="text-danger" id="key_info" style="font-size: 13px"></small>
    </div>

    <div class="form-group" style="margin-top: 20px">
        <button class="button button_theme w-100"><span class="button_label">Cadastrar-me</span></button>
    </div>
</form>

<script>
    $(document).on('keyup', 'input[name=confirm_password]', function() {
        var master = $('input[name=password]').val();

        if($(this).val() != master)
            $('#key_info').css('color', 'red').text('senhas divergentes.');
        else
            $('#key_info').css('color', '#0B0').text('senhas ok.');
    });

    $(document).on('submit', '#jmart_signup_form', function(e) {
        e.preventDefault();
        e.stopPropagation();
        var master = $('input[name=password]').length;

        if(master < 8) {
            swal('Atenção!', 'Sua senha deve conter no mínimo 8 caracteres.', 'error');
            return;
        }

        var data = $(this).serialize();

        $.post($(this).attr('action'), data).done(res => {
            swal(
                'Sucesso!',
                'Cadastro feito com sucesso! Agora você pode realizar a compra dos produtos do Clube Saudável.',
                'success'
            );
        }).fail(error => {
            alert('Um erro foi gerado enquanto tentava ser feito o cadastro. \n \n \n' + error);
            console.log(error);
        });
    });
</script>