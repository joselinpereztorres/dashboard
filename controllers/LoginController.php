<?php 
    require_once (__DIR__ . '/../models/login.models.php');


    class LoginController extends Controller {

        public function index() {

            include (__DIR__. '/../views/auth/login/login.php');
        }
        public function login() {

            if (isset($_POST["email"])) {

                $email = trim($_POST["email"]);
                $password = trim($_POST["password"]);

                $login = LoginModel::login($email);
               
                echo '<pre>'; print_r($login); echo '</pre>';

                if($login){

                    // VALIDAR PASSWORD
                    if(!password_verify($password, $login["password"])){

                        $this->flash("error","Correo o contraseña incorrecta","/login");
                    }

                    // VALIDAR ACTIVO
                    if ((int)$login["status"] != 1) {

                        $this->flash("error","Cuenta inactiva","/login");
                    }

                    // CREAR SESIÓN
                    $_SESSION["id_usuario"] = $login["id_usuario"];
                    $_SESSION["rol"] = $login["rol"];
                    $_SESSION["nombre"] = $login["nombre"];
                   
                 
                    header("Location: /inicio");
                    exit;

                }else{

                     $this->flash("error","Correo o contraseña incorrecta","/login");
                }
            }
        }
       
    }
?>