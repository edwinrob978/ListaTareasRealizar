<?php

require_once "conexion.php";

class EstadoModelo{

    static public function mdlListarEstado(){
        $stmt = Conexion::conectar()->prepare("SELECT id_estado, nombre_estado
                                                        FROM estado c 
                                                        order by nombre_estado asc");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}