<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv=”Content-Type” content=”text/html; charset=ISO-8859-1″ />
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?= media(); ?>css/styleLogin.css" />
    
    <title><?php echo $data ['page_title'];?></title>
    
  </head>
  <body>
    
    <div class="container sign-up-mode">
      <div class="forms-container">
        <div class="signin-signup">
          <div id="divLoading" >
            <div>
              <img src="<?= media(); ?>img/login/loading1.svg" alt="Loading">
            </div>
          </div>
          <form   class="sign-up-form" id="formCambiarPass" name="formCambiarPass" >
            <input type="hidden" name="idUsuario" id="idUsuario" value="<?= $data['id_usuario']; ?>" required>
            <input type="hidden" name="txtEmail" id="txtEmail" value="<?= $data['email']; ?>" required>
            <input type="hidden" name="txtToken" id="txtToken" value="<?= $data['token']; ?>" required>
            <h2 class="title"><i class="fas fa-key"></i> Cambiar Contraseña</h2>
            <div class="input-field">
              <i class="fas fa-unlock-alt"></i>
              <input type="password"  name="txtPassword" id="txtPassword" placeholder="Nueva Contraseña"  />
            </div>
             <div class="input-field">
              <i class="fas fa-unlock-alt"></i>
              <input type="password"  name="txtPasswordConfirm" id="txtPasswordConfirm" placeholder="Confirmar Contraseña"  />
            </div>
            <button  class="btn btn-success" type="submit" ><i class="fas fa-lock-open"></i> RENOVAR</button> 
          </form>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel"></div>

        <div class="panel right-panel">
          <div class="content">
            <h3>Renovar Contraseña </h3>
            <p>
              Digita Correctamente tu Contraseña Para no Tener Inconvenientes.
            </p>
            <h1><i class="fas fa-key"></i></h1>
          </div>
          <img src="<?= media(); ?>img/login/loginAdm.svg" class="image" alt="" />
        </div>

      </div>
    </div>

    <script >
      const BASE_URL= "<?= base_url();  ?>";
    </script>
    <script src="<?=  media();?>js/Login/fontawesomeLogin.js"></script>
    <script src="<?=  media();?>vendor/jquery/jquery.min.js"></script>
    <script src="<?=  media();?>js/Login/<?= $data['page_functionResetPass']; ?>"></script>
    <script src="<?= media();?>vendor/plugins/js/sweetalert.min.js"></script>

  </body>
</html>
