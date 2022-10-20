
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><span class="fas fa-fw fa-plus"></span><?php echo $pagina; ?></h1>
                    <br>

                    <!--contenedor de laertas del sistema-->
                        <div id="alert-container"></div>
                    <!--FIN-->

                    <div class="row clearfix d-flex justify-content-center">
                        <div class="col-md-11">
                            <!--contenido-->
                            <div class="card shadow border-left-secondary">
                                <div class="card-body">
                                    <!--formulario de registro de nueva insidencia-->
                                    <form action="<?php echo base_url(); ?>index.php/tickets/save_ticket" method="POST" id = "ticket_save_form">
                                    <!--titulo de la insidencia-->
                                        <div class="row clearfix d-flex justify-content-center">
                                            <div class="col-md-10">
                                                <div class="input-group shadow">
                                                    <label for="" class="input-group-text"><span class = "fas fa-fw fa-list"></span></label>
                                                    <input type="text" name="titulo" class="form-control" placeholder="TITULO">
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
                                                    <input type="text" name="fec_ini" class="form-control" placeholder="__/__/____">
                                                </div>
                                            </div>

                                            <div class="col-md-5">
                                                <div class="input-group shadow">
                                                    <label for="" class="input-group-text"><span class = "fas fa-fw fa-calendar"></span></label>
                                                    <input type="text" name="fec_fin" class="form-control" placeholder="__/__/____">
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

                                                    </textArea>
                                                </div>
                                            </div>
                                        </div>
                                    <!---->

                                    <!--fecha de inicio y fin de la insidencia-->
                                    <div class="row clearfix d-flex justify-content-center">
                                            <div class="col-md-5">
                                                <div class="input-group mb-3">
                                                    <label class="input-group-text" for="inputGroupSelect01"><span class = "fas fa-fw fa-user"></span></label>
                                                    <select class="form-select" id="user_select" name="user_select">
                                                        <option value="0">SELECCIONAR USUARIO</option>
                                                        <?php foreach($usuarios as $usr){ ?>
                                                            <?php if($usr->id_rol_fk == 1 || $usr->id_rol_fk == 3){ ?>
                                                                <option value="<?php echo $usr->id?>"><?php echo $usr->usuario?></option>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-5">
                                                <div class="input-group mb-3">
                                                    <label class="input-group-text" for="inputGroupSelect02"><span class = "fas fa-fw fa-user"></span></label>
                                                    <select class="form-select" id="client_select" name="client_select">
                                                        <option value="0">SELECCIONAR CLIENTE</option>
                                                        <?php foreach($usuarios as $usr){ ?>
                                                            <?php if($usr->id_rol_fk == 2){ ?>
                                                                <option value="<?php echo $usr->id?>"><?php echo $usr->usuario?></option>
                                                            <?php } ?>
                                                        <?php } ?>
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
                                                    <option value="0" selected>SELECCIONE ESTATUS</option>
                                                    <?php foreach ($status as $sts) { ?>
                                                        <option value="<?php echo $sts->id?>"><?php echo $sts->denominacion; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    <!---->

                                    <br>
                                    <!--Boton de registro-->
                                    <div class="row clearfix d-flex justify-content-center">
                                            <div class="col-md-10">
                                                <div class="input-group shadow">
                                                   <button type = "submit" class="btn btn-success w-100 rounded-0 shadow">
                                                    <span class="fas fa-fw fa-save"></span>
                                                    REGISTRAR
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
    <script src="<?php echo base_url();?>assets/vendor/moment/moment.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url();?>assets/vendor/datepicket/js/bootstrap-material-datetimepicker.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url();?>assets/system/jsTickets.js"></script>

    <script>
        $('#fec_ini').bootstrapMaterialDatePicker({ 
            weekStart : 0, 
            time: false,
            format: 'DD/MM/YYYY' 
        });
        $('#fec_fin').bootstrapMaterialDatePicker({ 
            weekStart : 0, 
            time: false,
            format: 'DD/MM/YYYY' 
        });
    </script>

</body>

</html>