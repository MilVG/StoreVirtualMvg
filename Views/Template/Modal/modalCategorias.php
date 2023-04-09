<div id="modalfrmCategorias" class="modal fade">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form id="formCategorias" name="formCategorias">
                 <input type="hidden" id="idCategorias" name="idCategorias" value="">
                 <input type="hidden" id="foto_actual" name="foto_actual" value="">
                 <input type="hidden" id="foto_remove" name="foto_remove" value="0">
                 <div class="modal-header headerRegister">
                        <div class="modal-title">
                            <h3 class="modal-title" id="titleModal">NUEVA CATEGORÍA</h3> 
                        </div>
                 </div>
                    <div class="modal-body shadow">
                        <p ><strong> Datos para una Nueva Categoria</strong></p>
                        <hr color="blue">
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-form-label">Nombre</label>
                                    <input type="text" name="txtnombre" id="txtnombre" class="form-control" >
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Descripción</label>
                                    <textarea type="text" name="txtDescripcion" id="txtDescripcion" class="form-control" ></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Estado</label>
                                        <select id="liststatus" name="liststatus" class="form-control selectpicker" required="">
                                         <option value="1" >Activo</option>
                                        <option value="2" >Inactivo</option>
                                        </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="photo">
                                    <label for="foto">Foto (570x380)</label>
                                    <div class="prevPhoto">
                                        <span class="delPhoto notBlock">X</span>
                                        <label for="foto"></label>
                                        <div>
                                            <img id="img" src="<?= media(); ?>img/uploads/portada_categoria.png">
                                        </div>
                                    </div>
                                    <div class="upimg">
                                        <input type="file" name="foto" id="foto">
                                    </div>
                                    <div id="form_alert"></div>
                                </div>
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

<div id="modalWiewCategoria" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header headerPrimary">
                  <div class="modal-title">
                      <h3 class="modal-title" id="titleModal">Categoria</h3>
                  </div>
            </div>
                    <div class="modal-body shadow">
                        
                       <table class="table table-bordered">
          <tbody>
            <tr>
              <td>Nombres:</td>
              <td id="celNombre">Jacob</td>
            </tr>
            <tr>
              <td>Descripción:</td>
              <td id="celDescripcion">Jacob</td>
            </tr>
            <tr>
              <td>Status:</td>
              <td id="celStatus">Larry</td>
            </tr>
            <tr>
              <td>Fecha registro:</td>
              <td id="celFechaRegistro">Larry</td>
            </tr>
            <tr>
              <td>portada:</td>
              <td id="celPortada">Larry</td>
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