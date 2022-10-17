
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><span class="fas fa-fw fa-undo"></span><?php echo $pagina; ?></h1>
                    <br>

                    <!--contenedor de laertas del sistema-->
                        <div id="alert-container"></div>
                    <!--FIN-->

                    <div class="row clearfix d-flex justify-content-center">
                        <div class="col-md-11">
                            <!--contenido-->
                            <div class="card shadow border-left-primary">
                                <div class="card-body">
                                    <?php foreach($ticket as $tick){ ?>
                                    <!--formulario de registro de nueva insidencia-->
                                    <form action="<?php echo base_url(); ?>index.php/tickets/update_ticket/<?php echo $cod; ?>" method="POST" id = "ticket_update_form">

                                    <!--titulo de la insidencia-->
                                        <div class="row clearfix d-flex justify-content-center">
                                            <div class="col-md-10">
                                                <div class="input-group shadow">
                                                    <label for="" class="input-group-text"><span class = "fas fa-fw fa-list"></span></label>
                                                    <input type="text" name="titulo" class="form-control" value = "<?php echo $tick->titulo?>" placeholder="TITULO">
                                                </div>
                                            </div>
                                        </div>
                                    <!---->
                                    <br>
                                    <!--fecha de inicio y fin de la insidencia-->
                                    <div class="row clearfix d-flex justify-content-center">
                                            <div class="col-md-5">
                                                <div class="input-group shadow">
                                                    <label for="" class="input-group-text"><span class = "fas fa-fw fa-calendar"></span></label>
                                                    <input type="text" id="fec_ini" name="fec_ini" class="form-control" value = "<?php echo date('d/m/Y', strtotime($tick->fecha_ini)); ?>" placeholder="__/__/____">
                                                </div>
                                            </div>

                                            <div class="col-md-5">
                                                <div class="input-group shadow">
                                                    <label for="" class="input-group-text"><span class = "fas fa-fw fa-calendar"></span></label>
                                                    <input type="text" id ="fec_fin" name="fec_fin" class="form-control" value = "<?php echo date('d/m/Y',strtotime($tick->fecha_fin)); ?>" placeholder="__/__/____">
                                                </div>
                                            </div>
                                        </div>
                                    <!---->
                                    <br>
                                    <!--Descripcion de la insidencia-->
                                    <div class="row clearfix d-flex justify-content-center">
                                            <div class="col-md-10">
                                                <div class="input-group shadow">
                                                    <label for="" class="input-group-text"><span class = "fas fa-fw fa-list"></span></label>
                                                    <textArea class="form-control" rows="3" cols="1" name="description">
                                                        <?php echo $tick->descripcion; ?>
                                                    </textArea>
                                                </div>
                                            </div>
                                        </div>
                                    <!---->

                                    <br>
                                    <!--fecha de inicio y fin de la insidencia-->
                                    <div class="row clearfix d-flex justify-content-center">
                                            <div class="col-md-5">
                                                <div class="input-group mb-3">
                                                    <label class="input-group-text" for="inputGroupSelect01"><span class = "fas fa-fw fa-user"></span></label>
                                                    <select class="form-select" id="user_select" name="user_select">
                                                        <?php foreach($usuarios as $usr){ ?>
                                                            <?php if($tick->id_usuario_soporte == $usr->id){ ?>
                                                                <option value="<?php echo $usr->id?>"><?php echo $usr->usuario?></option>
                                                            <?php }else{ ?>
                                                                <?php if($usr->id_rol_fk == 1 || $usr->id_rol_fk == 3){ ?>
                                                                    <option value="<?php echo $usr->id?>"><?php echo $usr->usuario?></option>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        <?php } ?>
                                                        <option value="0">SELECCIONAR USUARIO</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-5">
                                                <div class="input-group mb-3">
                                                    <label class="input-group-text" for="inputGroupSelect02"><span class = "fas fa-fw fa-user"></span></label>
                                                    <select class="form-select" id="client_select" name="client_select">
                                                        <?php foreach($usuarios as $usr){ ?>
                                                            <?php if($tick->id_usuario_soporte == $usr->id){ ?>
                                                                <option value="<?php echo $usr->id?>"><?php echo $usr->usuario?></option>
                                                            <?php }else{ ?>
                                                                <?php if($usr->id_rol_fk == 2){ ?>
                                                                    <option value="<?php echo $usr->id?>"><?php echo $usr->usuario?></option>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        <?php } ?>
                                                        <option value="0">SELECCIONAR CLIENTE</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    <!---->
                                    <br>

                                    <!--Estatus de la insidencia-->
                                        <div class="row clearfix d-flex justify-content-center">
                                            <div class="col-md-10">
                                                <select name="estatus_select" class="form-select p-2 w-100">
                                                    <?php foreach ($status as $sts) { ?>
                                                        <?php if($tick->id_status_fk == $sts->id){ ?>
                                                            <option value="<?php echo $sts->id?>"><?php echo $sts->denominacion; ?></option>
                                                        <?php }else{?>
                                                            <option value="<?php echo $sts->id?>"><?php echo $sts->denominacion; ?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                                    <option value="0" selected>SELECCIONE ESTATUS</option>
                                                </select>
                                            </div>
                                        </div>
                                    <!---->
                                <?php } ?>
                                    <br>
                                    <!--Boton de registro-->
                                    <div class="row clearfix d-flex justify-content-center">
                                            <div class="col-md-10">
                                                <div class="input-group shadow">
                                                   <button type = "submit" class="btn btn-warning w-100 rounded-0 shadow">
                                                    <span class="fas fa-fw fa-save"></span>
                                                    ACTUALIZAR
                                                   </button>
                                                </div>
                                            </div>
                                        </div>
                                    <!---->
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Sistema de Gestion de Incidencias TI - 2022</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo base_url();?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url();?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url();?>assets/js/sb-admin-2.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url();?>assets/system/funciones.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url();?>assets/vendor/moment/moment.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url();?>assets/vendor/datepicket/js/bootstrap-material-datetimepicker.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url();?>assets/system/jsTickets.js"></script>

</body>

</html>