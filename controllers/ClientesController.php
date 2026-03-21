<?php 
    require_once (__DIR__ . '/../models/clientes.models.php');


    class ClientesController extends Controller {
        private $id;

        public function __construct(){
           
        }

        public function index() {




            $this->checkAuth();   // valida sesión
            $lista= ClientesModel::mostrarRegistro();

            
            $this->render('clientes','clientes', ['lista' => $lista], 'plantilla');
        }

        public function crear() {
            if(isset($_POST["nombre"])){
                $idadmin= $_SESSION["id_admin"];
                $nombre=$_POST["nombre"];
                $ape_paterno=$_POST["apellido_pat"];
                $ape_materno=$_POST["apellido_mat"];
                $telefono=$_POST["telefono"];
                $fecha_naci=$_POST["fecha_nacimiento"];
                $telemerg=$_POST["tel_emergencia"];
                $status= 'nuevo';
                $num_visitas='0';


                $cliente= ClientesModel::crearCliente($idadmin,$nombre,$ape_paterno,$ape_materno,$telefono,$fecha_naci,$telemerg,$status,$num_visitas);

                $this->flash("success","Cliente creado correctamente","/clientes");
                
            }
        }

        public function manage($idCodificado) {

            $id_cliente = base64_decode($idCodificado);
            $id_cliente = (int)$id_cliente;
            $lista= ClientesModel::mostrarCliente($id_cliente);
            $campos = [
                'nombre' => ['label'=>'Nombre','type'=>'text'],
                'apellido_pat' => ['label'=>'Apellido Paterno','type'=>'text'],
                'apellido_mat' => ['label'=>'Apellido Materno','type'=>'text'],
                'telefono' => ['label'=>'Teléfono','type'=>'text'],
                'fecha_nacimiento' => ['label'=>'Fecha','type'=>'date'],
                'tel_emergencia' => ['label'=>'Teléfono','type'=>'text']
            ];

            $this->render('manage','manage','admin', ['campos'=> $campos, 'lista'=>$lista, 'controller' => 'clientes'], 'plantilla');
        }

        public function editar(){
            $this->checkAuth();

            $id_cliente = (int) $_POST['id_cliente'];

            $nombre = trim($_POST['nombre']);
            $apellido_pat = trim($_POST['apellido_pat']);
            $apellido_mat = trim($_POST['apellido_mat']);
            $telefono = trim($_POST['telefono']);
            $fecha_nacimiento = $_POST['fecha_nacimiento'];
            $tel_emergencia = trim($_POST['tel_emergencia']);

            ClientesModel::editarCliente(
                $id_cliente,
                $this->id,
                $nombre,
                $apellido_pat,
                $apellido_mat,
                $telefono,
                $fecha_nacimiento,
                $tel_emergencia
            );

            $this->flash("success","Cliente editado correctamente","/clientes");

            
        }

        public function eliminar(){
            $this->checkAuth();

            $id_cliente = (int) $_POST['id_cliente'];
            $lista= ClientesModel::eliminarCliente($id_cliente, $this->id);
            header('Content-Type: application/json');

            if($lista){
                echo json_encode(
                   ["status"         => "200"]);
            }
        }
    }
?>