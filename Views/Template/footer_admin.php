          </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
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

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Estas Seguro de Cerrar Sessión?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body"><div><center><img src="<?= media(); ?>img/salir.svg" width="60%" height="60%" ></center></div></div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-primary" href="<?= base_url(); ?>Logout">Salir</a>
                </div>
            </div>
        </div>
    </div>


    <script>

        const BASE_URL = "<?= base_url();?>";
    </script>
    

    <script src="<?= media();?>vendor/tinymce/tinymce.min.js"></script>
<!-- fontawezone -->
    <script src="<?= media();?>vendor/fontawesome-free/js/all.min.js"></script> 
    <!-- Bootstrap core JavaScript-->
    <script src="<?= media();?>vendor/jquery/jquery.min.js"></script> 
    
    <script src="<?= media();?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= media();?>vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= media();?>js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="<?= media();?>vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <!-- <script src="<?= media();?>js/demo/chart-area-demo.js"></script>
    <script src="<?= media();?>js/demo/chart-pie-demo.js"></script> -->

    <!-- tables diseño scripts -->
    <!-- <script src="<?= media();?>vendor/datatables/jquery-3.5.1.js"></script> -->
    
     <!-- <script src="<?= media();?>vendor/bootstrap/js/popper.min.js"></script> -->
     
     
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.5/umd/popper.min.js" integrity="sha512-8cU710tp3iH9RniUh6fq5zJsGnjLzOWLWdZqBMLtqaoZUA6AWIE34lwMB3ipUNiTBP5jEZKY95SfbNnQ8cCKvA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="<?= media();?>vendor/bootstrap/js/bootstrap.min.js"></script>
    
    <!-- sweet Alert -->

    <script src="<?= media();?>vendor/plugins/js/sweetalert.min.js"></script>
    


    
    <script src="<?= media();?>vendor/datatables/datatables.min.js"></script>
    <script src="<?= media();?>vendor/datatables/DataTables-1.11.5/js/dataTables.bootstrap4.min.js"></script> 
    <script src="<?= media();?>vendor/plugins/js/bootstrapSelect/bootstrap-select.min.js"></script>
    <script src="<?= media();?>js/functions_Principales.js"></script>
    
    <?php if ($data['page_name']=="roles") {?>
    <script src="<?= media();?>js/Usuarios/modalRoles.js"></script>
    <?php }?>

    <?php if ($data['page_name']=="usuarios") {?>
     <script src="<?= media();?>js/Usuarios/funUsuarios.js"></script>
    <?php }?>

     <?php if ($data['page_name']=="perfil" || $data['page_name']=="config") {?>
        <script src="<?=  media();?>js/Usuarios/<?= $data['page_function_general']; ?>"></script>
    <?php }?>

    <?php if ($data['page_name']=="clientes") {?>
        <script src="<?= media();?>js/Clientes/<?= $data['page_function_clientes']?>"></script>
    <?php }?>

    <?php if ($data['page_name']=="categorias") {?>
        <script src="<?= media();?>js/Categorias/<?= $data['page_function_categorias']?>"></script>
    <?php }?>

     <?php if ($data['page_name']=="productos") {?>
        <script src="<?= media();?>js/Productos/<?= $data['page_function_productos']?>"></script>
    <?php }?>
     <?php if ($data['page_name']=="pedidos") {?>
        <script src="<?= media();?>js/Pedidos/<?= $data['page_function_pedidos']?>"></script>
    <?php }?>
    <!-- buttons datatable -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap4.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.colVis.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script> 

    <!-- resposive datatable -->
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script> 
    
     <!--selecionar filas datatable  -->
    <script type="text/javascript" src="https://cdn.datatables.net/select/1.3.4/js/dataTables.select.min.js"></script>


    
</body>

</html>