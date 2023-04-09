<?php

$orden = $data['pedido']['orden'];
$detalle = $data['pedido']['detalle'];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orden</title>
    <style>
        p {
            font-family: arial;
            letter-spacing: 1px;
            color: #7f7f7f;
            font-size: 12px;
        }

        hr {
            border: 0;
            border-top: 1px solid #CCC;
        }

        h4 {
            font-family: arial;
            margin: 0;
        }

        table {
            width: 100%;
            max-width: 600px;
            margin: 10px auto;
            border: 1px solid #CCC;
            border-spacing: 0;
        }

        table tr td,
        table tr th {
            padding: 5px 10px;
            font-family: arial;
            font-size: 12px;
        }

        #detalleorden tr td {
            border: 1px solid #CCC;
        }

        .table-active {
            background-color: #CCC;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        @media screen and (max-width:470px) {
            .logo {
                width: 90px;
            }

            p,
            table tr td,
            table tr th {
                font-size: 9px;
            }
        }
    </style>
</head>

<body>
    <div>
        <br>
        <p class="text-center">Se ha generado una orden, a continuación encontrarás los datos</p>
        <br>
        <hr>
        <br>
        <table>
            <tr>
                <td width="33.33%">
                    <img class="logo" src="<?= media();?>tienda/images/icons/logo-01.png" alt="logo">
                </td>
                <td width="33.33%">
                    <div class="text-center">
                        <H4><strong><?= NOMBRE_EMPESA?></strong></H4>
                        <p>
                            <?= DIRECCION?> <br>
                            Telefono: <?= TELEMPRESA?> <br>
                            Email: <?= EMAIL_EMPRESA?>
                        </p>
                    </div>
                </td>
                <td width="33.33%">
                    <div class="text-right">
                        <p>
                            No. Orden: <strong><?= $orden['id_pedidos']?></strong> <br>
                            Fecha: <?= $orden ['fecha']?> <br>
                            <?php 
                                if ($orden['tipopagoid'] == 1) {
                                    
                                
                            ?>
                            Método pago: <?= $orden ['tipopago']?> <br>
                            Transacción: <?= $orden['idtransaccionpaypal']?>
                            <?php } else{?>
                                Método pago: Pago contra entrega <br>
                                tipo pago:  <?= $orden['tipopago']?>
                            <?php }?>
                        </p>
                    </div>
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td width="140">Nombre:</td>
                <td><?= $_SESSION['userData']['nombre'].' '.$_SESSION['userData']['apellidos']?></td>
            </tr>
            <tr>
                <td>Teléfono</td>
                <td><?= $_SESSION['userData']['telefono']?></td>
            </tr>
            <tr>
                <td>Dirección de envío</td>
                <td><?= $orden['direccion_envio'] ?></td>
            </tr>
        </table>
        <table>
            <thead class="table-active">
                <tr>
                    <th>Descripción</th>
                    <th class="text-right">precio</th>
                    <th class="text-center">cantidad</th>
                    <th class="text-right">Importe</th>
                </tr>
            </thead>
            <tbody id="detalleOrden">
                <?php 
                    if (count($detalle) >0) {
                        $Subtotal = 0;
                        foreach ($detalle as $producto){
                            $precio = formatMoney($producto['precio']);
                            $importe = formatMoney($producto['precio'] * $producto['cantidad']);
                            $Subtotal += $importe;
                ?>
                    <tr>
                        <td><?= $producto['producto']?></td>
                        <td class="text-right"><?= SMONEY.' '.$precio?></td>
                        <td class="text-center"><?= $producto['cantidad']?></td>
                        <td class="text-right"><?= SMONEY.' '.$importe?></td>
                    </tr>
                <?php 
                    }
                }
                ?>
            </tbody>
            <tbody>
                <tr>
                    <th colspan="3" class="text-right">Subtotal:</th>
                    <td class="text-right"><?= SMONEY.' '.formatMoney($Subtotal)?></td>
                </tr>
                <tr>
                    <th colspan="3" class="text-right">Envio:</th>
                    <td class="text-right"><?= SMONEY.' '.formatMoney($orden['costo_envio'])?></td>
                </tr>
                <tr>
                    <th colspan="3" class="text-right">Total:</th>
                    <td class="text-right"><?= SMONEY.' '.formatMoney($orden['monto']);?></td>
                </tr>
            </tbody>
        </table>
        <div class="text-center">
            <p>Si tienes preguntas sobre tu pedido,<br>pongase e contacto con nombre,telefono y Email</p>
            <h4>¡Gracias por tu compra!</h4>
        </div>
    </div>
</body>

</html>