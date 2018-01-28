<script type="text/javascript">
    function validate() {
        var s = 0;

        var password = document.forms["login-form"]["login-form-pass"].value;
        var password1 = document.forms["login-form"]["login-form-password"].value;
            if (password != password1){
                s++;
                swal("Contraseñas no iguales", "Deben ser iguales.", "warning");
                }


            if (password == null || password.length < 5 || /^\s+$/.test(password) || password.length > 12){
                s++;
                swal("Contraseña", "Debe ser de 5 a 12 caracteres.", "warning");
                }

        if (s > 0) {
            return false;
        }
    }
</script>
<body class="stretched">
    <div class="clearfix">
        <section id="content">
            <div class="content-wrap nopadding">
                <div class="section nopadding nomargin" style="width: 100%; height: 100%; position: fixed; left: 0; top: 0; background-size: cover;background-color: rgba(230,230,230,1);"></div>
                <div class="section nobg full-screen nopadding nomargin">
                    <div class="container vertical-middle divcenter clearfix">
                        <br><br>
                        <div class="panel panel-default divcenter noradius noborder" style="max-width: 400px; background-color: rgba(255,255,255,1);">
                            <div class="panel-body" style="padding: 40px;box-shadow: 0px 5px 15px;">
                                <center>
                                    <a><img width="220" height="98" src="<?php echo base_url(); ?>img/logo.png" alt="UCM Logo"></a>
                                </center>
                                <br><br>
                                <form name= "login-form" id="login-form" class="nobottommargin" action="<?php echo base_url(); ?>index.php/Login/cambiar_pass" method="post" onsubmit="return validate()">
                                    <div class="col_full">
                                        <label for="login-form-pass">Nueva Contraseña</label>
                                        <input type="password" id="login-form-pass" name="login-form-pass" value="" class="form-control not-dark" />
                                    </div>

                                    <div class="col_full">
                                        <label for="login-form-password">Reingresar Nueva Contraseña:</label>
                                        <input type="password" id="login-form-password" name="login-form-password" value="" class="form-control not-dark" />
                                    </div>

                                    <div class="col_full nobottommargin">
                                        <button class="button button-3d nomargin col-sm-12" id="login-form-submit" name="login-form-submit" value="login">CAMBIAR</button>
                                    </div>
                                </form>
                                <div class="line line-sm"></div>
                                <h5 align = "center"><a href="<?php echo base_url(); ?>index.php/Login" class="button button-circle button-mini button-3d button-light button-white"></i><?php echo lang('vl_pagina principal');?></a></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/sweetalert.min.js"></script>
