<?php
if (session_status() === PHP_SESSION_NONE) session_start();

if (!empty($_SESSION["flash"])) {
  $type = $_SESSION["flash"]["type"];
  $msg  = $_SESSION["flash"]["msg"];
  unset($_SESSION["flash"]);
  ?>
  <script>
    window.addEventListener("load", function () {
      fncSweetAlert("<?= $type ?>", "<?= $msg ?>");
    });
  </script>
  <?php
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <script src="/public/assets/js/alerts.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="/public/assets/plugins/material-preloader/material-preloader.css">
    <link rel="stylesheet" href="/public/assets/plugins/tags-input/tags-input.css">
	<link rel="stylesheet" href="/public/assets/plugins/toastr/toastr.min.css">


    
    <script src="/public/assets/plugins/jquery/jquery.min.js"></script>
	<script src="/public/assets/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="/public/assets/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="/public/assets/plugins/material-preloader/material-preloader.js"></script> 
	<script src="//publicassets/plugins/toastr/toastr.min.js"></script>
    
    <link rel="stylesheet" href="/public/assets/css/root.css">
    <link rel="stylesheet" href="/public/assets/css/dashboard.css">
    <link rel="stylesheet" href="/public/assets/css/login.css">
    <title>Document</title>

</head>
<body>
   


    <div class="login">

    <div class="login__interface">

        
        <div class="login__user">
            <div class="login__information">
                <i class="bi bi-person-circle"></i>
            </div>

            <div class="login__form">
                <form method="POST" id="formLogin">
                    <div class="login__question">
                        <i class="bi bi-envelope"></i>
                        <input type="email" name="email" id="email" placeholder="Correo electronico">
                    </div>

                    <div class="login__question">
                        <i class="bi bi-eye-slash"></i>
                        <input type="password" name="password" id="password" placeholder="Contraseña">
                    </div>

                    <div class="login__check">
                        <input type="checkbox" name="" id="">
                        <label for="">Recordar ingreso</label>
                    </div>
                    <button type="submit" class="login__button">Enviar</button>

                    
                </form>
            </div>
        </div>  
        <div class="login__welcome">
            <img src="/public/assets/img/welcome.jpg" alt="">
            

            <div class="login__info">
                <h1>Bienvenido</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod, officiis debitis quibusdam sint libero impedit at corrupti provident amet iste laboriosam, adipisci est, eligendi maxime! Eius iure quidem animi quas!</p>
            </div>
        </div>

    </div>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/public/assets/js/dashboard.js"></script>
    <script src="/public/assets/js/login.js"></script>

    
     


</body>
</html>

