<?php headerAdmin($data); 
getModal("modalRoles",$data);
?>
<?php navadmin($data); ?>
<div id="contentAjax"></div>
<!-- aqui va la navegacion completa -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                   
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">
                            <i class="fas fa-users"></i> Roles  de usuario
                             <?php if($_SESSION['permisosMod']['w']) {?>
                            <button class="btn btn-primary shadow" onclick="abrirModRol()">Nuevo</button>
                            <?php }?>
                        </h1>
                        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generar Reporte</a> -->
                    </div>
                   
                    
                    

                    <!-- Content Row -->
                    <div class="table-responsive mt-3">
                       
                        <table id="datatblRoles" class="table table-striped table-bordered shadow dt-responsive nowrap hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Rol</th>
                                    <th>Status</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>id</th>
                                    <th>Rol</th>
                                    <th>status</th>
                                    <th>Opciones</th>
                                </tr>
                            </tfoot>
                        </table>
                       
                    </div>

                </div>
                <!-- /.container-fluid -->

<?php footerAdmin($data); ?>
  <!-- en esta parte va el footer -->