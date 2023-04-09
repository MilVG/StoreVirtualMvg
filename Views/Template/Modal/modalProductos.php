<div id="modalfrmProductos" class="modal fade">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form id="formProductos" name="formProductos">
                 <input type="hidden" id="idProductos" name="idProductos" value="">
                 <div class="modal-header headerRegister">
                        <div class="modal-title">
                            <h3 class="modal-title" id="titleModal">NUEVO PRODUCTO</h3> 
                        </div>
                 </div>
                    <div class="modal-body shadow">
                        <p ><strong> Datos para el Nuevo Producto</strong></p>
                        <hr color="blue">
                        
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label class="col-form-label">Nombre Producto</label>
                                    <input type="text" name="txtNombre" id="txtNombre" class="form-control"  required="">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Descripción Producto</label>
                                    <textarea type="text" name="txtDescripcion" id="txtDescripcion" class="form-control"  rows="6"></textarea>
                                </div>
                               
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-form-label">Código</label>
                                    <input type="text" name="txtCodigo" id="txtCodigo" class="form-control" placeholder="Código de barra" required="">
                                    <br>

                                    <div id="divBarCode" class="notBlock textcenter">
                                        <div id="printCode">
                                            <svg id="barcode"></svg>
                                        </div>
                                        <button class="btn btn-success btn-sm" type="button" onclick="fntPrintBarcode('#printCode')"><i class="fas fa-print"></i>
                                            Imprimir
                                        </button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="col-form-label">Precio</label>
                                        <input type="text" name="txtPrecio" id="txtPrecio" class="form-control" placeholder="" required="">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="col-form-label">Stock</label>
                                        <input type="text" name="txtStock" id="txtStock" class="form-control" placeholder="" required="">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="col-form-label">Categoria</label>
                                        <select type="text" name="listCategoria" id="listCategoria" class="form-control" data-live-search="true" required=""></select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="">Estado</label>
                                        <select id="listStatus" name="listStatus" class="form-control selectpicker" required="">
                                            <option value="1" >Activo</option>
                                            <option value="2" >Inactivo</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                   <div class="form-group col-md-6 ">
                                        <button id="btnActionForm" class="btn btn-primary btn-lg btn-block" type="submit"><i class="fa fa-fw fa-lg fa-check-circle" aria-hidden="true"></i><span id="btnText">Guardar</span></button>
                                   </div>
                                   <div class="form-group col-md-6 ">
                                        <button class="btn btn-danger btn-lg btn-block" type="button" data-dismiss="modal" value="cancelar"><i class="app-menu__icon fas fa-sign-out-alt" aria-hidden="true"></i> Salir</button>
                                   </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                                         <div class="form-group col-md-12">
                     <div id="containerGallery">
                         <span>Agregar foto (440 x 545)</span>
                         <button class="btnAddImage btn btn-info btn-sm" type="button">
                             <i class="fas fa-plus"></i>
                         </button>
                     </div>
                     <hr>
                     <div id="containerImages">
                         <!-- <div id="div24">
                             <div class="prevImage">
                                 <img src="<?= media(); ?>img/uploads/portada_categoria.png">
                             </div>
                             <input type="file" name="foto" id="img1" class="inputUploadfile">
                             <label for="img1" class="btnUploadfile"><i class="fas fa-upload "></i></label>
                             <button class="btnDeleteImage" type="button" onclick="fntDelItem('div24')"><i class="fas fa-trash-alt"></i></button>
                         </div>
                         <div id="div24">
                             <div class="prevImage">
                                 <img class="loading" src="<?= media(); ?>img/uploads/loading1.svg">
                             </div>
                             <input type="file" name="foto" id="img1" class="inputUploadfile">
                             <label for="img1" class="btnUploadfile"><i class="fas fa-upload "></i></label>
                             <button class="btnDeleteImage" type="button" onclick="fntDelItem('div24')"><i class="fas fa-trash-alt"></i></button>
                         </div> -->
                        
                     </div>
                 </div>
                    </div>
                </form>
            </div>
        </div>
</div>

<div id="modalWiewProducto" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header headerPrimary">
                  <div class="modal-title">
                      <h3 class="modal-title" id="titleModal">Producto</h3>
                  </div>
            </div>
            <div class="modal-body shadow">
                        
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>Codigo:</td>
                            <td id="celCodigo"></td>
                        </tr>
                        <tr>
                            <td>Nombres:</td>
                            <td id="celNombre"></td>
                        </tr>
                        <tr>
                            <td>Precio:</td>
                            <td id="celPrecio"></td>
                        </tr>
                        <tr>
                            <td>Stock:</td>
                            <td id="celStock"></td>
                        </tr>
                        <tr>
                            <td>Categoría:</td>
                            <td id="celCategoria"></td>
                        </tr>
                        <tr>
                            <td>Status:</td>
                            <td id="celStatus"></td>
                        </tr>
                        <tr>
                            <td>Descripción:</td>
                            <td id="celDescripcion"></td>
                        </tr>
                        <tr>
                            <td>Fotos de referencia:</td>
                            <td id="celFotos"></td>
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