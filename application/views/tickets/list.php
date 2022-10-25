
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><span class="fas fa-fw fa-list"> </span><?php echo $pagina; ?></h1>

                    <!--grafico-->
                    <div class="row clearfix d-flex justify-content-center">
                        <div class="col-md-11">
                            <div class="card shadow border-left-secondary">
                                <div class="card-body">
                                    <canvas id="tickets_bar_char" height="65"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!---->

                    <div class="row clearfix d-flex justify-content-center">
                        <div class="col-md-11">
                            <!--contenido-->
                            <div class="card shadow border-left-secondary">
                                <div class="card-body">
                                    <!--boton para crear nuevo ticket-->
                                    <div class="row clearfix d-flex justify-content-end">
                                        <div class="col-md-2">
                                            <a href="<?php echo base_url(); ?>index.php/tickets/newTicket" class="btn btn-success btn-sm rounded-0 w-100 shadow"><span class="fa fa-plus"></span> CREAR TICKET</a>
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
                                                            <td>CODIGO</td>
                                                            <td>DENOMINACION</td>
                                                            <td>INICIO</td>
                                                            <td>SOLICITADO POR</td>
                                                            <td>ASIGNADO A</td>
                                                            <td>STATUS</td>
                                                            <td>ACCIONES</td>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="load_ticket_inf" class="text-center">
                                                        <?php foreach($tickets as $a){?>
                                                            <?php echo $a; ?>
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
    <script src="<?php echo base_url();?>assets/vendor/chart.js/Chart.min.js"></script>

    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/demo/chart-bar-demo.js"> </script>
    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url();?>assets/system/jsTickets.js"></script>

    <script>
        // Bar Chart Example
        var ctx = document.getElementById("tickets_bar_char");
        var myBarChart = new Chart(ctx, {
          type: 'bar',
          data: {
            labels: ["ABIERTO", "CERRADO", "RESUELTO", "ASIGNADO"],
            datasets: [{
              label                 : "ESTADISTICA DE SOPORTES",
              backgroundColor       : "#4e73df",
              hoverBackgroundColor  : "#2e59d9",
              borderColor           : "#4e73df",
              data                  : [
                <?php echo $chart[0]; ?>,
                <?php echo $chart[1]; ?>,
                <?php echo $chart[2]; ?>, 
                <?php echo $chart[3]; ?>
              ],
            }],
          },

          options : {
            responsive: true,
            scales : {
              yAxes : [{
                ticks:{
                  beginAtZero : true
                }
              }]
            }
          }
        });

    </script>
   

</body>

</html>