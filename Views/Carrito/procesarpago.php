<?php
headerTienda($data);
$tota = 0;
$subtotal = 0;

foreach ($_SESSION['arrCarrito'] as $producto) {
    $subtotal += $producto['precio'] * $producto['cantidad'];
}
$total = $subtotal + COSTOENVIO;
?>
<script src="https://www.paypal.com/sdk/js?client-id=<?= IDCLIENTE ?>&currency=USD"></script>
<script>
    window.addEventListener('load', function() {
        if (document.querySelector("#paypal-btn-container")) {
            paypal.Buttons({
                // Sets up the transaction when a payment button is clicked
                createOrder: (data, actions) => {
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: <?= $total; ?> // Can also reference a variable or function
                            },
                            description: "Compra de Articulos en <?= NOMBRE_EMPESA ?>  por <?= SMONEY . $total ?>",
                        }]
                    });
                },
                // Finalize the transaction after payer approval
                onApprove: (data, actions) => {
                    return actions.order.capture().then(function(orderData) {
                        let base_url = "<?= base_url() ?>";
                        let direccion = $("#txtDireccion").val();
                        let ciudad = $("#txtCiudad").val();
                        let inttipopago = 1;
                        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('microsoft.XMLHTTP');
                        let ajaxurl = base_url + 'Tienda/procesarventa';
                        let formData = new FormData();
                        formData.append('direccion', direccion);
                        formData.append('ciudad', ciudad);
                        formData.append('inttipopago', inttipopago);
                        formData.append('datapay', JSON.stringify(orderData));
                        request.open("POST", ajaxurl, true);
                        request.send(formData);
                        request.onreadystatechange = function() {
                            if (request.readyState != 4) return;
                            if (request.status == 200) {
                                let objData = JSON.parse(request.responseText);
                                if (objData.status) {
                                    window.location = base_url + "tienda/confirmarpedido";
                                } else {
                                    swal("", objData, "error");
                                }
                            }
                        }
                    });
                }
            }).render('#paypal-btn-container');
        }
    });
</script>

<!-- Modal para terminos y Condiciones-->

<div class="modal fade" id="modalTerminos" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Términos y Condiciones</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Modi, sequi ad doloribus facilis magnam laborum corporis quo eveniet! Cumque, ex omnis nulla ea porro unde maxime laborum at placeat aliquid. Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse impedit saepe fugiat excepturi quos commodi quas quasi magnam a omnis, illum laborum quidem magni eveniet ratione cum quam ex vel.
                    <br>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi illo libero totam incidunt et. Dolor laboriosam labore explicabo, molestiae, minus illum facere maxime sed itaque facilis aliquam illo ratione velit.</p>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb -->
<br><br><br>
<hr>
<div class="container">
    <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
        <a href="<?= BASE_URL(); ?>" class="stext-109 cl8 hov-cl1 trans-04">
            Inicio
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>

        <span class="stext-109 cl4">
            <?= $data['page_title'] ?>
        </span>
    </div>
</div>
<br>
<!-- Shoping Cart -->

<div class="container">
    <div class="row">
        <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
            <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-l-25 m-r--38 m-lr-0-xl">
                <div>
                    <?php
                    if (isset($_SESSION['login'])) {


                    ?>
                        <div>
                            <label for="tipopago">Dirección de Envío</label>
                            <div class="bor8 bg0 m-b-12">
                                <input id="txtDireccion" class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="state" placeholder="Dirección de Envío">
                            </div>
                            <div class="bor8 bg0 m-b-12">
                                <input id="txtCiudad" class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="postcode" placeholder="Ciudad / Estado">
                            </div>
                        </div>
                    <?php } else { ?>
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#login" role="tab" aria-controls="nav-home" aria-selected="true">Iniciar Sessión</a>
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#registro" role="tab" aria-controls="nav-profile" aria-selected="false">Crear Cuenta</a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="nav-home-tab">

                                <form id="frmLogin">
                                    <div class="form-group">
                                        <label for="txtCorreo">Usuario</label>
                                        <input type="email" class="form-control" id="txtCorreo" name="txtCorreo" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="txtpassword">Contraseña</label>
                                        <input type="password" class="form-control" id="txtpassword" name="txtpassword" placeholder="">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                                </form>

                            </div>
                            <div class="tab-pane fade" id="registro" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <form id="formRegister">
                                    <div class="row">

                                        <div class="col col-md-6 form-group">
                                            <label for="txtNombre">Nombres</label>
                                            <input type="text" class="form-control valid validText" id="txtNombre" name="txtNombre" placeholder="">
                                        </div>
                                        <div class="col col-md-6 form-group">
                                            <label for="txtApellido">Apellidos</label>
                                            <input type="text" class="form-control valid validText" id="txtApellido" name="txtApellido" placeholder="">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col col-md-6 form-group">
                                            <label for="txtTelefono">Teléfono</label>
                                            <input type="text" class="form-control valid valiTelefono" id="txtTelefono" name="txtTelefono" placeholder="">
                                        </div>
                                        <div class="col col-md-6 form-group">
                                            <label for="txtEmailCliente">Email</label>
                                            <input type="email" class="form-control valid validEmail" id="txtEmailCliente" name="txtEmailCliente" placeholder="">
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Regístrate</button>
                                </form>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>

        <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
            <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                <h4 class="mtext-109 cl2 p-b-30">
                    Resumen
                </h4>

                <div class="flex-w flex-t bor12 p-b-13">
                    <div class="size-208">
                        <span class="stext-110 cl2">
                            Subtotal:
                        </span>
                    </div>

                    <div class="size-209">
                        <span id="subTotalCompra" class="mtext-110 cl2">
                            <?= SMONEY . formatMoney($subtotal) ?>
                        </span>
                    </div>

                    <div class="size-208">
                        <span class="stext-110 cl2">
                            Envío:
                        </span>
                    </div>

                    <div class="size-209">
                        <span class="mtext-110 cl2">
                            <?= SMONEY . formatMoney(COSTOENVIO) ?>
                        </span>
                    </div>
                </div>

                <div class="flex-w flex-t p-t-27 p-b-33">
                    <div class="size-208">
                        <span class="mtext-101 cl2">
                            Total:
                        </span>
                    </div>

                    <div class="size-209 p-t-1">
                        <span id="totalCompra" class="mtext-110 cl2">
                            <?= SMONEY . formatMoney($total) ?>
                        </span>
                    </div>
                </div>
                <hr>
                <?php
                if (isset($_SESSION['login'])) {
                ?>
                    <div id="divMetodoPago">
                        <div id="divCondiciones">
                            <input type="checkbox" name="" id="Condiciones">
                            <label for="condiciones">Aceptar</label>
                            <a href="" data-toggle="modal" data-target="#modalTerminos">terminos y Condiciones</a>

                        </div>
                        <div id="optMetodoPago">
                            <hr>
                            <h4 class="mtext-109 cl2 p-b-30">
                                Método de pago
                            </h4>

                            <h4 class="mtext-109 cl2 p-b-30">
                                Método de pago
                            </h4>
                            <div class="divmetodpago">
                                <div>
                                    <label for="paypal">
                                        <input type="radio" id="paypal" class="methodpago" name="payment-method" checked="" value="paypal">
                                        <img src="<?= media() ?>img/img-paypal.jpg" alt="Icono de Paypal" class="ml-space-sm" width="74" height="20">
                                    </label>
                                </div>

                                <div>
                                    <label for="contraentrega">
                                        <input type="radio" id="contraentrega" class="methodpago" name="payment-method" value="CT">
                                        <span>Contra Entrega</span>
                                    </label>
                                </div>
                                <br>

                                <div id="divtipopago">
                                    <label for="listtipopago">Tipo de Pago</label>
                                    <div class="rs1-select2 rs2-select2 bord8 bg0 m-b-12 m-t-9">
                                        <select class="js-select2" id="listtipopago" name="time">
                                            <?php
                                            if (count($data['tiposPago']) > 0) {

                                                foreach ($data['tiposPago'] as $tipopago) {
                                                    if ($tipopago['idtipopago'] != 1) {

                                            ?>
                                                        <option value="<?= $tipopago['idtipopago'] ?>"><?= $tipopago['tipopago'] ?></option>
                                            <?php
                                                    }
                                                }
                                            }
                                            ?>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                    <button type="submit" id="btncomprar" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
                                        Procesar Pedido
                                    </button>

                                </div>

                                <div id="divPaypal">
                                    <div id="msgpaypal">
                                        <p>Para completar la transaccion, te enviaremos a los servidores seguros de Paypal</p>
                                    </div>
                                    <div id="paypal-btn-container"></div>
                                </div>
                            </div>
                        </div>

                    </div>

                <?php } ?>
            </div>
        </div>
    </div>
</div>


<?php
footerTienda($data);
?>