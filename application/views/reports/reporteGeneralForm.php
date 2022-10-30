
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><span class="fas fa-fw fa-list"> </span><?php echo $pagina; ?></h1>


                    <div class="row clearfix d-flex justify-content-center">
                        <div class="col-md-11">
                            <!--contenido-->
                            <div class="card shadow border-left-secondary">
                                <div class="card-body">
                                    
                                    <!-- data table para listar tickets -->
                                    <div class="row clearfix d-flex justify-content-center">
                                        <div class="col-md-12">
                                            <form action="<?php echo base_url(); ?>index.php/CharAndReports/pdfGeneralTickets" method = "POST">
                                            <!--Filtros de busqueda para tickets-->
                                            <div class="row clearfix d-flex justify-content-center">
                                                <div class="col-md-5">
                                                   <div class="input-group">
                                                       <label class="input-group-text">
                                                           <span class="fa fa-calendar"></span>
                                                       </label>
                                                       <input type="text" id="ini" name="ini" class="form-control" placeholder="FECHA DE INICIO">
                                                   </div> 
                                                </div>
                                                <div class="col-md-5">
                                                   <div class="input-group">
                                                       <label class="input-group-text">
                                                           <span class="fa fa-calendar"></span>
                                                       </label>
                                                       <input type="text" id="fin" name="fin" class="form-control" placeholder="FECHA DE FIN">
                                                   </div> 
                                                </div>
                                            </div>
                                            <br>    
                                            <!--FIN-->
                                            <div class="row clearfix d-flex justify-content-center">
                                                <div class="col-md-5">
                                                    <button class="btn btn-primary rounded-0 shadow w-100">
                                                        <span class="fa fa-print"></span>
                                                        GENERAR REPORTE
                                                    </button>
                                                </div>
                                            </div>
                                            </form>
                                            <br>
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
    <script src="<?php echo base_url();?>assets/vendor/moment/moment.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url();?>assets/vendor/datepicket/js/bootstrap-material-datetimepicker.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url();?>assets/system/funciones.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url();?>assets/vendor/chart.js/Chart.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/demo/chart-bar-demo.js"> </script>
    <script>
        $('#ini').bootstrapMaterialDatePicker({ 
            weekStart : 0, 
            time: false,
            format: 'DD/MM/YYYY' 
        });
        $('#fin').bootstrapMaterialDatePicker({ 
            weekStart : 0, 
            time: false,
            format: 'DD/MM/YYYY' 
        });
    </script>
</body>

</html>