
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
                                    <form action="<?php echo base_url(); ?>index.php/usuarios/insert_user" method="POST" id = "user_save_form">

                                    <!--nacionalidad-->
                                        <div class="row clearfix d-flex justify-content-center">
                                            <div class="col-md-4">
                                                <div class="input-group shadow">
                                                    <label for="" class="input-group-text"><span class = "fas fa-fw fa-list"></span></label>
                                                   <select name="select-nac" id="" class="form-select">
                                                       <?php foreach($nacionalidades as $nac){ ?>
                                                            <option value="<?php echo $nac->id; ?>"><?php echo $nac->cod; ?></option>
                                                       <?php } ?>
                                                   </select>
                                                   <input type="text" name="dni" id = "dni_user" class="form-control" placeholder="DNI">
                                                </div>
                                            </div>
                                        </div>
                                    <!---->
                                    <br>
                                    <!--nombre y apellido de la persona-->
                                    <div class="row clearfix d-flex justify-content-center">
                                            <div class="col-md-5">
                                                <div class="input-group shadow">
                                                    <label for="" class="input-group-text"><span class = "fas fa-fw fa-user"></span></label>
                                                    <input type="text" name="nom" class="form-control" placeholder="NOMBRE">
                                                </div>
                                            </div>

                                            <div class="col-md-5">
                                                <div class="input-group shadow">
                                                    <label for="" class="input-group-text"><span class = "fas fa-fw fa-user"></span></label>
                                                    <input type="text" name="ape" class="form-control" placeholder="APELLIDO">
                                                </div>
                                            </div>
                                        </div>
                                    <!---->
                                    <br>
                                    
                                    
                                    <!--fecha de inicio y fin de la insidencia-->
                                    <div class="row clearfix d-flex justify-content-center">
                                            <div class="col-md-5">
                                                <div class="input-group mb-3">
                                                    <label class="input-group-text" for="inputGroupSelect01"><span class = "fas fa-fw fa-envelope"></span></label>
                                                    <input type="text" name="mail" id="mail" class="form-control" placeholder="XX@XX.com">
                                                </div>
                                            </div>

                                            <div class="col-md-5">
                                                <div class="input-group mb-3">
                                                    <label class="input-group-text" for="inputGroupSelect02"><span class = "fas fa-fw fa-phone"></span></label>
                                                   <input type="text" name="telf" id="telf" class="form-control" placeholder="XXXX-XXXXXXX">
                                                </div>
                                            </div>
                                        </div>
                                    <!---->
                                    <br>

                                     <div class="row clearfix d-flex justify-content-center">
                                        <div class="col-md-10">
                                            <div class="input-group shadow">
                                                <label for="" class="input-group-text"><span class = "fas fa-fw fa-list"></span></label>
                                               <textarea class="form-control" rows="3" cols="0" name="dir">
                                                   
                                               </textarea>
                                            </div>
                                        </div>
                                    </div>

                                     <div class="row clearfix d-flex justify-content-center">
                                        <div class="col-md-6">
                                            <div class="input-group shadow">
                                                <label for="" class="input-group-text"><span class = "fas fa-fw fa-calendar"></span></label>
                                                <input type="text" name="fec_nac" id="fec_nac" class="form-control" placeholder = " fecha de nacimiento"required>
                                            </div>
                                        </div>
                                    </div>
                                    <br>

                                    <!--fecha de inicio y fin de la insidencia-->
                                    <div class="row clearfix d-flex justify-content-center">
                                            <div class="col-md-5">
                                                <div class="input-group mb-3">
                                                    <label class="input-group-text" for="inputGroupSelect01"><span class = "fas fa-fw fa-user-circle"></span></label>
                                                    <input type="text" name="user" id="user" class="form-control" placeholder="NOMBRE DE USUARIO">
                                                </div>
                                            </div>

                                            <div class="col-md-5">
                                                <div class="input-group mb-3">
                                                    <label class="input-group-text" for="inputGroupSelect02"><span class = "fas fa-fw fa-lock"></span></label>
                                                   <input type="text" name="pass" id="telf" class="form-control" placeholder="CLAVE">
                                                </div>
                                            </div>
                                        </div>
                                    <!---->
                                     <br>
                                     <div class="row clearfix d-flex justify-content-center">
                                        <div class="col-md-6">
                                            <div class="input-group shadow">
                                                
                                                <select name="rol-select" id="" class="form-select w-100">
                                                    <option value="1">ADMINISTRADOR</option>
                                                    <option value="2">CLIENTE</option>
                                                    <option value="3">SOPORTE TECNICO</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
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
    <script src="<?php echo base_url();?>assets/vendor/inputmask/dist/jquery.inputmask.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url();?>assets/system/jsUsuarios.js"></script>

    <script>
        $('#fec_nac').bootstrapMaterialDatePicker({ 
            weekStart : 0, 
            time: false,
            format: 'DD/MM/YYYY' 
        });
    </script>


</body>

</html>