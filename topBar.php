<?php include "styles.php" ?>

<div id="topBar" class="bg-theme p-1 text-white">
    <div class="container">
        <!--        <div class="row">-->
        <div class="column one-second my-0" id="social-icons">
            <!--<a href="#"><img src="<?php echo plugins_url('jmart/assets/icons/facebook.png') ?>" width="25px"></a>-->
            <a href="https://www.instagram.com/_marinamorais_/"><img src="<?php echo plugins_url('jmart/assets/icons/instagram.png') ?>" width="25px"></a>
            <!--<a href="#"><img src="<?php echo plugins_url('jmart/assets/icons/twitter.png') ?>" width="25px"></a>-->
        </div>
        <div class="column one-second text-right my-0">

            <div class="column one-second my-0">
                <?php echo do_shortcode('[wpdreams_ajaxsearchlite]');?>
            </div>

            <div class="column one-second my-0">
                <?php if (isset(get_user()->name) && !empty(get_user()->name)): ?>
                    <button class="btn btn-theme m-0" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span id="welcome-message">Bem-vindo(a),</span> <strong><?php echo explode(' ', get_user()->name)[0] ?></strong>
                    </button>
                    <a class="dropdown-item" href="#" id="logout">Sair</a>
                <?php else: ?>
                    <div class="dropdown-jmart">
                        <button class="btn btn-theme m-0">Acessar</button>
                        <div class="dropdown-jmart-content">
                            <a href="<?php echo 'https://api-sec-vlc.hotmart.com/security/oauth/authorize?response_type=code&client_id=' . config('CLIENT_ID')->value . '&redirect_uri=' . site_url() ?>">
                                Já tenho cadastro</a>
                            <a href="<?php echo site_url(). '/cadastro'?>">Cadastrar-me</a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>


        </div>
        <!--        </div>-->
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<script src="<?php echo plugins_url('/jmart/assets/js/main.js'); ?>"></script>