<div  class="modal fade " id="modalPermisos">
    <div class="modal-dialog modal-xl shadow">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title">Permisos Roles de usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
            </div>
            <div class="modal-body">
                <?php 
                    //dep($data);
                ?>
                <form action="" id="formPermisos" name="formPermisos">
                    <input type="hidden" id="idrol" name="idrol" value="<?= $data['idrol'];?>" required="">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Modulo</th>
                                    <th scope="col">Ver</th>
                                    <th scope="col">Crear</th>
                                    <th scope="col">Actualizar</th>
                                    <th scope="col">Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $no =1;
                                    $modulos = $data['modulos'];
                                    for ($i=0; $i <count($modulos) ; $i++) { 
                                        $permisos = $modulos[$i]['permisos'];
                                        $rCheck = $permisos['r'] == 1? "checked":"";
                                        $wCheck = $permisos['w'] == 1? "checked":"";
                                        $uCheck = $permisos['u'] == 1? "checked":"";
                                        $dCheck = $permisos['d'] == 1? "checked":"";

                                        $idmod = $modulos[$i]['idmodulo'];
                                    
                                ?>
                                <tr>
                                    <td>
                                         <?= $no; ?>
                                        <input type="hidden" name="modulos[<?= $i; ?>][idmodulo]" value="<?= $idmod ?>" required >
                                    </td>
                                    <td>
                                        <?= $modulos[$i]['titulo']; ?>
                                    </td>
                                    <td>
                                        <div class="toggle-flip">
                                            <label>
                                                <input type="checkbox" name="modulos[<?= $i; ?>][r]" <?= $rCheck ?> ><span class="flip-indecator" data-toggle-on="ON" data-toggle-off="OFF"></span>
                                            </label>
                                        </div>            
                                    </td>
                                    <td>
                                        <div class="toggle-flip">
                                            <label>
                                                <input type="checkbox" name="modulos[<?= $i; ?>][w]" <?= $wCheck ?> ><span class="flip-indecator" data-toggle-on="ON" data-toggle-off="OFF"></span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="toggle-flip">
                                            <label>
                                                <input type="checkbox" name="modulos[<?= $i; ?>][u]" <?= $uCheck ?>><span class="flip-indecator" data-toggle-on="ON" data-toggle-off="OFF"></span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="toggle-flip">
                                            <label>
                                                <input type="checkbox" name="modulos[<?= $i; ?>][d]" <?= $dCheck ?>><span class="flip-indecator" data-toggle-on="ON" data-toggle-off="OFF"></span>
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                <?php 
                                    $no++;
                                  }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle" aria-hidden="true"></i> Guardar</button>
                        <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="app-menu__icon fas fa-sign-out-alt" aria-hidden="true"></i> Salir</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>