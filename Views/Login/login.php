<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv=”Content-Type” content=”text/html; charset=ISO-8859-1″ />
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?= media(); ?>css/styleLogin.css" />
    
    <title><?php echo $data ['page_title'];?></title>
    
  </head>
  <body>
    
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          <div id="divLoading" >
            <div>
              <img src="<?= media(); ?>img/login/loading1.svg" alt="Loading">
            </div>
          </div>
          <form class="sign-in-form" id="frmLogin" name="frmLogin">
            <label for="txtusuario"><h2 class="title"><i class="fas fa-user-secret"></i> INICIAR SESSIÓN</h2></label>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" name="txtCorreo" id="txtCorreo" placeholder="Email" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" name="txtpassword" id="txtpassword" placeholder="Password" />
            </div>
            <button class="btn btn-success" type="submit" ><i class="fas fa-sign-in-alt"></i> INICIAR SESSIÓN</button>
          </form>
          <form   class="sign-up-form" id="formRecetPass" name="formRecetPass" >
            <h2 class="title"><i class="fas fa-lock"></i> ¿Olvidaste tu Contraseña?</h2>
            <div class="input-field">
              <i class="fas fa-at"></i>
              <input type="email"  name="txtEmailReset" id="txtEmailReset" placeholder="Correo"  />
            </div>
            <button  class="btn btn-success" type="submit" ><i class="fas fa-lock-open"></i> RENOVAR</button> 
          </form>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>¿Olvidaste tu Contraseña?</h3>
            <p>
              La recuperación de su contraseña se envirá a su correo.
            </p>
            <h3><i class="fas fa-reply-all"></i></h3><button class="btn transparent" id="sign-up-btn">Renovar</button>
          </div>
          <img src="<?= media(); ?>img/login/loginVendedor.svg" class="image" alt="" />
        </div>

        <div class="panel right-panel">
          <div class="content">
            <h3>Ingresar </h3>
            <p>
              Si ya recuperaste tu contraseña Ingresa Nuevamente.
            </p>
            <h3><i class="fas fa-sign-in-alt"></i></h3><button class="btn transparent" id="sign-in-btn">Login</button>
          </div>
          <img src="<?= media(); ?>img/login/loginAdm.svg" class="image" alt="" />
        </div>

      </div>
    </div>

    <script >
      const BASE_URL= "<?= base_url();  ?>";
    </script>
    <script src="<?=  media();?>js/Login/Ingresar.js"></script>
    <script src="<?=  media();?>js/Login/fontawesomeLogin.js"></script>
    <script src="<?=  media();?>vendor/jquery/jquery.min.js"></script>
    <script src="<?=  media();?>js/Login/<?= $data['page_function_login']; ?>"></script>
    <script src="<?= media();?>vendor/plugins/js/sweetalert.min.js"></script>

  </body>
</html>
