<?php headerAdmin($data);
getModal("modalProductos", $data);
?>
<?php navadmin($data); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- aqui va la navegacion completa -->

    <!-- Page Heading -->

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-box-tissue"></i> Pedidos
        </h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generar Reporte</a> -->
    </div>
    <!-- Content Row -->
    <div class="table-responsive">

        <table id="datatblPedidos" class="table table-striped table-bordered shadow dt-responsive nowrap hover" style="width:100%">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Ref./ Transacción</th>
                    <th>Fecha</th>
                    <th>Monto</th>
                    <th>Tipo pago</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th>Id</th>
                    <th>Ref./ Transacción</th>
                    <th>Fecha</th>
                    <th>Monto</th>
                    <th>Tipo pago</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </tfoot>
        </table>

    </div>
</div>
<!-- /.container-fluid -->

<?php footerAdmin($data); ?>
<!-- en esta parte va el footer -->