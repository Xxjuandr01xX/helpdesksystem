<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo $titulo_pagina; ?></title>
    <!-- Enlaces de CSS para las hojas de estilo-->
    <link href="<?php echo base_url()?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="<?php echo base_url()?>assets/css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-secondary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">
                <div id="alert"></div>                
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row clearfix d-flex justify-content-end">
                            <div class="col-lg-6 d-none d-lg-block">
                                <img src="<?php echo base_url(); ?>assets/img/slider1.jpg" width = "468" height = "418" alt="">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4"><img src="<?php echo base_url(); ?>assets/img/login.png" alt=""></h1>
                                    </div>
                                    <form class="user" id="user_form" method = "POST" action="<?php echo base_url().'index.php/login/verificar'?>">
                                        <div class="form-group input-group">
                                            <label for="" class="input-group-text"><span class="fa fa-user"></span></label>
                                            <input type="text" class="form-control" name="user_name" placeholder="Nombre de usuario">
                                        </div>
                                        <div class="form-group input-group">
                                            <label for="" class="input-group-text"><span class="fa fa-lock"></span></label>
                                            <input type="password" class="form-control" name="user_pass" placeholder="clave">
                                        </div>
                                        <button type = "submit" class="btn btn-success rounded-0 w-100">
                                            Iniciar Session
                                        </button>
                                    </form>
                                        <hr>
                                        <a href="#" class="text-center">Registrarse</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo base_url()?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url()?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url()?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url()?>assets/js/sb-admin-2.min.js"></script>
    <script src="<?php echo base_url()?>assets/system/funciones.js" type="text/javascript"></script>
    <script src="<?php echo base_url()?>assets/system/JsLogin.js" type="text/javascript"></script>
</body>

</html>