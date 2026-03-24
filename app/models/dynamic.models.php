<?php

    class DynamicModel {
   

        public static function getDatos($tabla){

            $permitidas = ["usuarios", "muestras", "clientes", "proyectos"];

            if(!in_array($tabla, $permitidas)){
                return [];
            }

            $stmt = InstallModel::conexion()->prepare(
                "SHOW COLUMNS from $tabla"
            );
            
            $stmt->execute();

            $resultado= $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            $nombres=[
                "muestras"=>"muestra",
                "usuarios"=>"usuario",
                "clientes"=>"cliente",
                "proyectos"=>"proyecto"
            ];

            $idTabla= "id_{$nombres[$tabla]}";
            $ocultar=[$idTabla, 'created_at','status','created_by','updated_at','updated_by'];

        
            $claves = InstallModel::conexion()->prepare(
                "SELECT COLUMN_NAME, REFERENCED_TABLE_NAME
                FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE
                WHERE TABLE_SCHEMA = 'laboratorio'
                AND TABLE_NAME = ?
                AND REFERENCED_TABLE_NAME IS NOT NULL"
            );

            $claves->execute([$tabla]);
            $resultadoClave = $claves->fetchAll(PDO::FETCH_ASSOC);

            // 🔹 5. Crear mapa FK → columna => tabla
            $mapFK = [];

            foreach ($resultadoClave as $fk) {
                $mapFK[$fk['COLUMN_NAME']] = $fk['REFERENCED_TABLE_NAME'];
            }

            // 🔹 6. Construir array final dinámico
            $columnas = [];

            foreach ($resultado as $col) {

                if (!in_array($col['Field'], $ocultar)) {
                    $tipo = explode("(", $col['Type'])[0];

                    $col['Type'] = $tipo;

                    
                    $col['es_fk'] = false;

                    if (isset($mapFK[$col['Field']])) {

                        $tablaRelacionada = $mapFK[$col['Field']];

                        if ($tablaRelacionada != 'usuarios') {

                            $col['es_fk'] = true;

                            $stmtFK = InstallModel::conexion()->prepare(
                                "SELECT * FROM $tablaRelacionada"
                            );

                            $stmtFK->execute();

                            $col['opciones'] = $stmtFK->fetchAll(PDO::FETCH_ASSOC);
                        }
                    }

                    $columnas[] = $col;
                }
            }

            return $columnas;
        }

        public static function getPrioridades(){
            return ['baja','normal','alta','urgente'];
        }

        public static function getEstados(){
            return ['pendiente','en_proceso','completado','cancelado'];
        }

    }
?> 

