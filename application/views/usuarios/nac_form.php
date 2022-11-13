
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><span class="fas fa-fw fa-list"> </span><?php echo $pagina; ?></h1>

                    <div class="row clearfix d-flex justify-content-center">
                        <div class="col-md-11">
                            <!--contenido-->
                            <div class="card shadow border-left-secondary">
                                <div class="card-body">
                                    <!--boton para crear nuevo ticket-->
                                    <div class="row clearfix d-flex justify-content-center">
                                        <div class="col-md-10">
                                        <form action="<?php echo base_url(); ?>index.php/usuarios/save_nac" method = "POST">
                                            <div class="input-group">
                                                <label for="" class="input-group-text">
                                                    <span class="fa fa-map"></span>
                                                </label>
                                                <input type="text" name="des" id="des" class="form-control">
                                                <input type="text" name="cod" id="cod" class="form-control">
                                                <label for="" class="input-group-text">
                                                    <span class="fa fa-phone"></span>
                                                </label>
                                                <input type="text" name="phone" id="phone" class="form-control">
                                                <label for="">
                                                    <span class="fa fa-list"></span>
                                                </label>
                                                <input type="text" name="doc" id="doc" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row clearfix d-flex justify-content-center">
                                        <div class="col-md-4">
                                            <button class="btn btn-success w-100 rounded-0">
                                                <span class="fa fa-save"></span>
                                                AGREGAR NACIONALIDAD
                                            </button>
                                        </div>
                                    </div>
                                    </form>
                                    <br>
                                    <br>
                                    <!-- data table para listar tickets -->
                                    <div class="row clearfix d-flex justify-content-center">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table class="table table-stripped table-hover w-100" id="tickets-table">
                                                    <thead class="bg-dark text-white text-center">
                                                        <tr>
                                                            <td>NRO</td>
                                                            <td>DESCRIPCION</td>
                                                            <td>DOCUMENTO</td>
                                                            <td>TELEFONO</td>
                                                            <td>ACCIONES</td>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="load_ticket_inf" class="text-center">
                                                        <?php $i=0; foreach($nacionalidades as $nac){ $i++; ?>
                                                            <tr>
                                                                <td><b><?php echo $i; ?></b></td>
                                                                <td><?php echo $nac->descripcion; ?></td>
                                                                <td><?php echo $nac->cod; ?></td>
                                                                <td><?php echo $nac->cod_tel; ?></td>
                                                                <td>
                                                                   <div class="btn-group">
                                                                       <a href="<?php echo base_url(); ?>index.php/usuarios/eliminar_nac/<?php echo $nac->id; ?>" class="btn btn-sm btn-danger rounded-0"><span class="fa fa-trash"></span></a>
                                                                   </div>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

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
    <script src="<?php echo base_url();?>assets/vendor/datatables/jquery.dataTables.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url();?>assets/system/funciones.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url();?>assets/vendor/inputmask/dist/jquery.inputmask.min.js"></script>

    <script>
        $("#des").inputmask("A{1,10}");
        $("#cod").inputmask("A{1,4}");
        $("#phone").inputmask("+9{1,4}");
        $("#doc").inputmask("A.-{1,1}");
    </script>

</body>

</html>