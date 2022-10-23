
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
                                    <div class="row clearfix d-flex justify-content-end">
                                        <div class="col-md-2">
                                            <a href="<?php echo base_url(); ?>index.php/usuarios/new" class="btn btn-success btn-sm rounded-0 w-100 shadow"><span class="fa fa-plus"></span> REGISTRAR USUARIO</a>
                                        </div>
                                    </div>
                                    <br>
                                    
                                    <!-- data table para listar tickets -->
                                    <div class="row clearfix d-flex justify-content-center">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table class="table table-stripped table-hover w-100" id="tickets-table">
                                                    <thead class="bg-dark text-white text-center">
                                                        <tr>
                                                            <td>NRO</td>
                                                            <td>NOMBRE Y APELLIDO</td>
                                                            <td>USUARIO</td>
                                                            <td>ROL</td>
                                                            <td>ACCIONES</td>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="load_ticket_inf" class="text-center">
                                                        <?php $i=0; foreach($usuarios as $usr){ $i++; ?>
                                                            <tr>
                                                                <td><b><?php echo $i; ?></b></td>
                                                                <td><?php echo $usr->nombre." ".$usr->apellido; ?></td>
                                                                <td><?php echo $usr->usuario?></td>
                                                                <td><?php echo $usr->descripcion; ?></td>
                                                                <td>
                                                                   <div class="btn-group">
                                                                       <a href="<?php echo base_url(); ?>index.php/usuarios/eliminar/<?php echo $usr->id; ?>" class="btn btn-sm btn-danger rounded-0"><span class="fa fa-trash"></span></a>
                                                                       <a href="<?php echo base_url(); ?>index.php/usuarios/editar/<?php echo $usr->id; ?>" class="btn btn-sm btn-warning rounded-0"><span class="fa fa-edit"></span></a>
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
    <script src="<?php echo base_url();?>assets/system/jsTickets.js"></script>

</body>

</html>