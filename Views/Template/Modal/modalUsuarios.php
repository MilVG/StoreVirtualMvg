<div id="modalfrmUsuarios" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="formUsuarios" name="formUsuarios">
                 <input type="hidden" id="idUsuario" name="idUsuario" value="">
                 <div class="modal-header headerRegister">
                        <div class="modal-title">
                            <h3 class="modal-title" id="titleModal">Nuevo Usuario</h3>
                        </div>
                 </div>
                    <div class="modal-body shadow">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                            <label for="txtIdentificacion">Dni</label>
                            <input type="text" class="form-control" id="txtIdentificacion" name="txtIdentificacion" required="">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                            <label for="txtNombre">Nombres</label>
                            <input type="text" class="form-control valid validText" id="txtNombre" name="txtNombre" required="">
                            </div>
                            <div class="form-group col-md-6">
                            <label for="txtApellido">Apellidos</label>
                            <input type="text" class="form-control valid validText" id="txtApellido" name="txtApellido" required="">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                            <label for="txtTelefono">Teléfono</label>
                            <input type="text" class="form-control valid validNumber" id="txtTelefono" name="txtTelefono" required="" onkeypress="return controlTag(event);">
                            </div>
                            <div class="form-group col-md-6">
                            <label for="txtEmail">Email</label>
                            <input type="email" class="form-control valid validEmail" id="txtEmail" name="txtEmail" required="">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="listRolid">Tipo usuario</label>
                                <select class="form-control" data-live-search="true" id="listRolid" name="listRolid" required >
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="listStatus">Status</label>
                                <select class="form-control selectpicker" id="listStatus" name="listStatus" required >
                                    <option value="1">Activo</option>
                                    <option value="2">Inactivo</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">

                             <div class="form-group col-md-6">
                            <label for="txtUsuario">Usuario</label>
                            <input type="text" class="form-control" id="txtUsuario" name="txtUsuario" >
                            </div>
                             
                            <div class="form-group col-md-6">
                            <label for="txtPassword">Password</label>
                            <input type="password" class="form-control" id="txtPassword" name="txtPassword" >
                            </div>
                        </div>
                        
                        
                    </div>
                    <div class="modal-footer">
                        <button id="btnActionForm" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle" aria-hidden="true"></i><span id="btnText">Guardar</span></button>
                        <button class="btn btn-danger" type="button" data-dismiss="modal" value="cancelar"><i class="app-menu__icon fas fa-sign-out-alt" aria-hidden="true"></i> Salir</button>
                    </div>
                </form>
            </div>
        </div>
</div>

<div id="modalWiewUsuario" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header headerPrimary">
                  <div class="modal-title">
                      <h3 class="modal-title" id="titleModal">Usuario</h3>
                  </div>
            </div>
                    <div class="modal-body shadow">
                        
                       <table class="table table-bordered">
          <tbody>
            <tr>
              <td>Dni:</td>
              <td id="celIdentificacion">654654654</td>
            </tr>
            <tr>
              <td>Nombres:</td>
              <td id="celNombre">Jacob</td>
            </tr>
            <tr>
              <td>Apellidos:</td>
              <td id="celApellido">Jacob</td>
            </tr>
            <tr>
              <td>Teléfono:</td>
              <td id="celTelefono">Larry</td>
            </tr>
            <tr>
              <td>Email (Usuario):</td>
              <td id="celEmail">Larry</td>
            </tr>
            <tr>
              <td>Tipo Usuario:</td>
              <td id="celTipoUsuario">Larry</td>
            </tr>
            <tr>
              <td>Estado:</td>
              <td id="celEstado">Larry</td>
            </tr>
            <tr>
              <td>Fecha registro:</td>
              <td id="celFechaRegistro">Larry</td>
            </tr>
          </tbody>
        </table> 
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-Secundary" type="button" data-dismiss="modal" value="cancelar"><i class="app-menu__icon fas fa-sign-out-alt" aria-hidden="true"></i> Cerrar</button>
                    </div>
            </div>
        </div>
</div>
