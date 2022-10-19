
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><span class="fas fa-fw fa-plus"></span><?php echo $pagina; ?></h1>
                    <br>

                    <!--contenedor de laertas del sistema-->
                        <div id="alert-container"></div>
                    <!--FIN-->
                    <!---->
                    <div class="row clearfix d-flex justify-content-center">
                        <div class="col-md-10">
                            <div class="card shadow border-left-primary">
                            <div class="card-body">
                                <div class="row clearfix d-flex justify-content-center">
                                    <div class="col-md-11">
                                        <div class="table-responsive">
                                            <table class="table table-stripped table-hover w-100">
                                                <?php foreach($ticket as $tick){ ?>
                                                    <tr>
                                                        <td><b>TICKER NRO:</b></td>
                                                        <td><?php echo $tick->codigo?></td>
                                                        <td><b>TITULO:</b></td>
                                                        <td><?php echo $tick->titulo?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>INICIO:</b></td>
                                                        <td><?php echo date('d/m/Y',strtotime($tick->fecha_ini)); ?></td>
                                                        <td><b>FIN:</b></td>
                                                        <td><?php echo date('d/m/Y',strtotime($tick->fecha_fin)); ?></td>
                                                    </tr>
                                                
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!---->
                    <?php } ?>
                    <br>
                    <!---->
                    <div class="row clearfix d-flex justify-content-center">
                        <div class="col-md-10">
                            <div class="card shadow border-left-primary">
                            <div class="card-body">
                                <div class="row clearfix d-flex justify-content-center">
                                    <div class="col-md-11">
                                        <div class="table-responsive">
                                            <table class="table table-stripped table-hover w-100 table-bordered">
                                                <?php foreach($historico as $hist){ ?>
                                                    <tr>
                                                        <td class="border-left-success text-center"><b>USUARIO:</b></td>
                                                        <td><?php echo $usuario; ?></td>
                                                        <td><b>OBSERVACION:</b></td>
                                                        <td><?php echo $hist->observacion; ?></td>
                                                        <td><b>FECHA:</b></td>
                                                        <td><?php echo date('d/m/y', strtotime($hist->fech_modi)); ?></td>
                                                        <td><b>HORA:</b></td>
                                                        <td><?php echo $hist->hora_modi; ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!---->
                    <br>
                    <!---->
                    <div class="row clearfix d-flex justify-content-center">
                        <div class="col-md-10">
                            <!--contenido-->
                            <div class="card shadow border-left-primary">
                                <div class="card-body">
                                    <!--formulario de registro de nueva insidencia-->
                                    <form action="<?php echo base_url(); ?>index.php/tickets/insert_observation/<?php echo $cod;?>" method="POST" id = "ticket_observation_form">
                                        <div class="row clearfix d-flex justify-content-center">
                                            <div class="col-sm-10">
                                                <div class="input-group">
                                                    <label for="" class="input-group-text"><span class="fa fa-list"></span></label>
                                                    <textarea class="form-control" name="observation-ticket">
                                                        
                                                    </textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <!---->
                                        <br>
                                        <div class="row clearfix d-flex justify-content-center">
                                            <div class="col-sm-10">
                                                <div class="input-group">
                                                    <select name="select-estatus" class = "form-select w-100 p-2">
                                                        <option value="0"> SELECCIONE UN ESTATUS</option>
                                                        <?php foreach($estatus as $sts){ ?>
                                                            <option value="<?php echo $sts->id?>"><?php echo $sts->denominacion; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                         <br>
                                         <div class="row clearfix d-flex justify-content-center">
                                            <div class="col-sm-10">
                                                <div class="input-group">
                                                    <label for="" class="input-group-text"><span class="fa fa-calendar"></span></label>
                                                    <input type="text" name="fec_obs" id="fec_obs" class="form-control" placeholder="__/__/____">
                                                </div>
                                            </div>
                                        </div>
                                         <br>
                                        <div class="row clearfix d-flex justify-content-center">
                                            <div class="col-sm-10">
                                                <button type = "submit" class="btn btn-success w-100 rounded-0 shadow">
                                                    <span class="fa fa-save"></span>
                                                    AGREGAR
                                                </button>
                                            </div>
                                        </div>
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
        $('#fec_obs').bootstrapMaterialDatePicker({ 
            weekStart : 0, 
            time: false,
            format: 'DD/MM/YYYY' 
        });
    </script>

</body>

</html>