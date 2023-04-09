<?php headerAdmin($data);?>
<?php navadmin($data); ?>
    
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row ">
            <div class="col-md-3 col-xl-2">
                <div class="card shadow border-primary ">
                    <div class="card-header border-primary">
                        <h5 class="card-title ">Configurar Perfil</h5>
                    </div>

                    <div class="list-group list-group-flush" role="tablist">
                        <a id="ConfigCuenta" class="list-group-item list-group-item-action border-primary active " >
                            Cuenta
                        </a>
                        <a id="perfilpassword" class="list-group-item list-group-item-action border-primary" >
                            Contraseña
                        </a>
                        <!-- <a class="list-group-item list-group-item-action border-primary" data-bs-toggle="list" href="#" role="tab">
                            Privacy and safety
                        </a>
                        <a class="list-group-item list-group-item-action border-primary" data-bs-toggle="list" href="#" role="tab">
                            Email notifications
                        </a>
                        <a class="list-group-item list-group-item-action border-primary" data-bs-toggle="list" href="#" role="tab">
                            Web notifications
                        </a>
                        <a class="list-group-item list-group-item-action border-primary" data-bs-toggle="list" href="#" role="tab">
                            Widgets
                        </a>
                        <a class="list-group-item list-group-item-action border-primary" data-bs-toggle="list" href="#" role="tab">
                            Your data
                        </a>
                        <a class="list-group-item list-group-item-action border-primary" data-bs-toggle="list" href="#" role="tab">
                            Delete account
                        </a> -->
                    </div>
                    
                </div>
            </div>
            <div class="col-md-9 col-xl-10">
                <div class="tab-content">
                    <div class="collapse multi-collapse active" id="account" role="tabpanel">

                        <div class="card shadow mt-3">
                            <div class="card-header">

                                <h5 class="card-title mb-0">Información Publica</h5>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="mb-3">
                                                <label class="form-label" for="user">Nombre de usuario</label>
                                                <input type="text" class="form-control" id="user" placeholder="usuario">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="correo">correo</label>
                                                <input type="email" class="form-control" id="correo" placeholder="correo"></input>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="text-center">
                                                <img alt="Charles Hall" src="https://us.123rf.com/450wm/yupiramos/yupiramos1612/yupiramos161204937/67327365-perfil-masculino-joven-en-colores-blanco-y-negro-sobre-fondo-blanco-ilustraci%C3%B3n-vectorial-.jpg" class="rounded-circle img-responsive mt-2" width="128" height="128">
                                                <!-- <div class="mt-2">
                                                    <span class="btn btn-primary"><i class="fas fa-upload"></i> Upload</span>
                                                </div> -->
                                                <div class="fileUpload">
                                                    <input type="file" class="upload" />
                                                    <span><i class="fas fa-upload"></i></span>
                                                </div>
                                                <small>For best results, use an image at least 128px by 128px in .jpg format</small>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-info">Actualizar datos</button>
                                </form>

                            </div>
                        </div>

                        <div class="card shadow mt-4">
                            <div class="card-header">

                                <h5 class="card-title mb-0">información Privada</h5>
                                <button  type="button" class="btn btn-outline-primary dropdown-toggle mt-3 " id="btnWiewData"   data-toggle="tooltip" data-placement="left" title="click y actualiza tus datos!!">Actualizar datos Privados</button>
                            </div>
                            <div class="card-body" id="showDtainfo" style="display: none;">
                                <form id="infoPri" name="infoPri">
                                    <div class="form-group row">
                                        <div class="form-group mb-3 col-md-6">
                                            <label  class="form-label" for="txtnombre">Nombre</label>
                                            <input type="text" class="form-control valid validText" id="txtnombre" name="txtnombre" placeholder="nombre" value="<?= $_SESSION['userData']['nombre'];?>" required="">
                                        </div>
                                        <div class="form-group mb-3 col-md-6">
                                            <label class="form-label" for="txtapellidos">Apellidos</label>
                                            <input  type="text" class="form-control valid validText" id="txtapellidos" name="txtapellidos" placeholder="apellidos" value="<?= $_SESSION['userData']['apellidos'];?>" required="">
                                        </div>
                                    </div>
                                    <div class="form-group mb-3 ">
                                        <label class="form-label" for="txtdni">Dni</label>
                                        <input type="text" class="form-control valid validNumber" id="txtdni" name="txtdni" placeholder="dni" value="<?= $_SESSION['userData']['dni'];?>" required="">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="txttelefono">Teléfono</label>
                                        <input type="text" class="form-control valid validNumber " id="txttelefono" name="txttelefono" placeholder="telefono" value="<?= $_SESSION['userData']['telefono'];?>" required="" onkeypress="return controlTag(event);">
                                    </div>
                                     <div class="form-group mb-3">
                                        <label class="form-label" for="txtdireccion">Dirección</label>
                                        <input type="text" class="form-control" id="txtdireccion" name="txtdireccion" placeholder="Ejemplo: jr.direccion #345" value="<?=  $_SESSION['userData']['direccion'];?>" required="">
                                    </div>
                                    <button type="button" class="btn btn-info" onclick="upAsincronoprueba()">Actualizar Datos</button>
                                
                            </form>

                            </div>
                            <div class="position-fixed bottom-0 right-0 p-3" style="z-index: 5; right: 0; bottom: 0;">
                                <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000">
                                    <div class="toast-header">
                                    <svg class="bd-placeholder-img rounded me-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#007aff"></rect></svg>
                                    <strong class="mr-auto text-primary ">Datos Privados</strong>
                                    <small>Notify</small>
                                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="toast-body">
                                        Actualiza Correctamente tus Datos.
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="collapse multi-collpase" id="password" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Contraseña</h5>

                                <form>
                                    <div class="mb-3">
                                        <label class="form-label" for="txtpasswordActual">Contraseña Actual</label>
                                        <input type="password" class="form-control" id="txtpasswordActual">
                                        
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="txtpasswordnew">Nueva Contraseña</label>
                                        <input type="password" class="form-control" id="txtpasswordnew">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="txtpasswordverfy">Verificar Contraseña</label>
                                        <input type="password" class="form-control" id="txtpasswordverfy">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                </form>

                            </div>
                        </div>
                    </div>
				</div>
            </div>
        </div>
        
        
    </div>
    <!-- /.container-fluid -->

<?php footerAdmin($data); ?>
  <!-- en esta parte va el footer -->