<script type="text/javascript">
    function validate() {
        var s = 0;

        var user = document.forms["login-form"]["login-form-username"].value;
        if (user === null || user.length < 3 || /^\s+$/.test(user)) {
            s++;
            swal("No se permiten campos nulos", "", "warning");
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
                                <form name= "login-form" id="login-form" class="nobottommargin" action="<?php echo base_url(); ?>index.php/Login/recpass" method="post" onsubmit="return validate()">
                                    <div class="col_full">
                                        <label for="login-form-username"><?php echo lang('vl_correo');?>:</label>
                                        <input type="text" id="login-form-username" name="login-form-username" value="" class="form-control not-dark" />
                                    </div>


                                    <div class="col_full nobottommargin">
                                        <button class="button button-3d nomargin col-sm-12" id="login-form-submit" name="login-form-submit" value="login">Recuperar Password</button>
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
