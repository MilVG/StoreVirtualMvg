<div id="modalfrmRoles" class="modal fade">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="formRoles" name="formRoles">
                 <input type="hidden" id="idRol" name="idRol" value="">
                 <div class="modal-header headerRegister">
                        <div class="modal-title">
                            <h3 class="modal-title" id="titleModal">Nuevo Rol</h3>
                        </div>
                 </div>
                    <div class="modal-body shadow">
                        
                        <div>
                        <div class="form-group">
                            <label class="col-form-label">Nombre</label>
                                <input type="text" name="txtnombre" id="txtnombre" class="form-control valid validText" >
                        </div>
                        <div class="form-group">
                            <label for="">Estado</label>
                            <select id="liststatus" name="liststatus" class="form-control" required="">
                                <option value="1" >Activo</option>
                                <option value="2" >Inactivo</option>
                            </select>
                        </div>
                        </div>
                        
                        
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
                        <button class="btn btn-primary" type="submit" id="btnActionForm" ><span id="btnText">Guardar</span></button>
                    </div>
                </form>
            </div>
        </div>
</div>
