<?
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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
	<script src="/public/assets/plugins/toastr/toastr.min.js"></script>
    
    <link rel="stylesheet" href="/public/assets/css/root.css">
    <link rel="stylesheet" href="/public/assets/css/dashboard.css">
    <link rel="stylesheet" href="/public/assets/css/login.css">
    <title>Document</title>

</head>
<body>
   


    <div class="dash">
     
        <?php include "components/navigations/sidebar.php";?>
        
        <div class="dash__main main">

        <?php include "components/navigations/header.php"; ?>

            
            <main class="dash__contenido">
                <?php echo $content;?>

            </main>

            <?php if (!empty($_SESSION["flash"])): 
                $type = $_SESSION["flash"]["type"];
                $msg  = $_SESSION["flash"]["msg"];
                unset($_SESSION["flash"]);
            ?>

            <script>
            window.addEventListener("load", function () {
                fncSweetAlert("<?= $type ?>","<?= $msg ?>");
            });
            </script>

            <?php endif; ?>

        </div>

    </div>

    

  

  
    <?php  include "app/views/components/modals/modal.php";?>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/public/assets/js/dashboard.js"></script>

    <script src="/public/assets/js/modal.js"></script>
    <script type="module" src="/public/assets/js/modules.js"></script>
     


</body>
</html>