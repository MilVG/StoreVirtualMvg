<div id="modalfrmClientes" class="modal fade">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form id="formClientes" name="formClientes">
                 <input type="hidden" id="idCliente" name="idCliente" value="">
                 <div class="modal-header headerRegister">
                        <div class="modal-title">
                            <h3 class="modal-title" id="titleModal">NUEVO CLIENTE</h3> 
                        </div>
                 </div>
                    <div class="modal-body shadow">
                        <p ><strong> Datos Cliente</strong></p>
                        <hr color="blue">
                        <div class="form-row ml-3" >
                            <div class="form-group col-md-2">
                            <label for="txtIdentificacion">Dni</label>
                            <input type="text" class="form-control valid validNumber validDni" id="txtIdentificacion" name="txtIdentificacion" required="">
                            </div>
                        </div>
                        <div class="form-row ml-3 " >
                            <div class="form-group col-md-6">
                            <label for="txtNombre">Nombres</label>
                            <input type="text" class="form-control valid validText" id="txtNombre" name="txtNombre" required="">
                            </div>
                            <div class="form-group col-md-6">
                            <label for="txtApellido">Apellidos</label>
                            <input type="text" class="form-control valid validText" id="txtApellido" name="txtApellido" required="">
                            </div>
                        </div>
                        <div class="form-row ml-3">
                            <div class="form-group col-md-6">
                            <label for="txtTelefono">Teléfono</label>
                            <input type="text" class="form-control valid  valiTelefono" id="txtTelefono" name="txtTelefono" required="">
                            </div>
                            <div class="form-group col-md-6">
                            <label for="txtEmail">Email</label>
                            <input type="email" class="form-control valid validEmail" id="txtEmail" name="txtEmail" required="">
                            </div>
                        </div>
                        <div class="form-row ml-3">
                            <div class="form-group col-md-6">
                            <label for="txtPassword">Pwassword</label>
                            <input type="password" class="form-control" id="txtPassword" name="txtPassword" required="">
                            </div>
                        </div>
                        <p ><strong> Datos Fiscales</strong></p>
                        <hr color="blue">
                        <div class="form-row ml-3">
                             <div class="form-group col-md-6">
                            <label for="txtRuc">RUC</label>
                            <input type="text" class="form-control valid validRuc" id="txtRuc" name="txtRuc" >
                            </div>
                        
                            <div class="form-group col-md-6">
                            <label for="txtRSocial">Razon Social</label>
                            <input type="text" class="form-control valid validText" id="txtRSocial" name="txtRSocial" >
                            </div>
                        </div>
                        <div class="form-row ml-3">
                            <div class="form-group form-row col-md-6">
                            <label for="txtDireccionFiscal">Dirección Fiscal</label>
                            <input type="text" class="form-control" id="txtDireccionFiscal" name="txtDireccionFiscal" >
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

<div id="modalWiewCliente" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header headerPrimary">
                  <div class="modal-title">
                      <h3 class="modal-title" id="titleModal">Cliente</h3>
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
              <td>Ruc:</td>
              <td id="ruc">Larry</td>
            </tr>
            <tr>
              <td>Razon Social:</td>
              <td id="nameRSocial">Larry</td>
            </tr>
            <tr>
              <td>Dirección Fiscal</td>
              <td id="dirFiscal">Larry</td>
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