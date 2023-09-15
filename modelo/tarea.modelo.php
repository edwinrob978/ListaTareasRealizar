<?php

require_once "conexion.php";
use PhpOffice\PhpSpreadsheet\IOFactory;

class TareasModelo{

    static public function mdlGetTareasListar(){//Tareas listado
        $stmt = Conexion::conectar()->prepare('call prc_tareas()');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    static public function mdlRegistrarTarea($nombre_tarea, $descripcion_tarea, $id_estado){//registro tareas
       
    try{
       $stmt = Conexion::conectar()->prepare("INSERT INTO tareas(nombre_tarea,
                                                                        descripcion_tarea, 
                                                                        id_estado) 
                                                VALUES (:nombre_tarea, 
                                                        :descripcion_tarea,
                                                        :id_estado)");

        $stmt -> bindParam(":nombre_tarea",$nombre_tarea,PDO::PARAM_STR);
        $stmt -> bindParam(":descripcion_tarea",$descripcion_tarea,PDO::PARAM_STR);
        $stmt -> bindParam(":id_estado",$id_estado,PDO::PARAM_STR);

        if($stmt -> execute()){
            $resultado = "ok";
        }else{
            $resultado = "error";
        }
    }
    catch (Exception $e){
        $resultado = 'Excepción Capturada: '. $e -> getMessage(). "\n";
    }
        return $resultado;
        $stmt = null;
    }

    static public function mdlActualizarTareas($table, $data, $id, $nameId){//Actualiza informacion
       
        $set = "";

        foreach ($data as $key => $value){

            $set .= $key." = :".$key.",";
            
        }
        
        $set = substr($set, 0, -1);

        $stmt = Conexion::conectar()->prepare("UPDATE $table SET $set WHERE $nameId = :$nameId");

        foreach ($data as $key => $value){
            $stmt -> bindParam(":".$key, $data[$key], PDO::PARAM_STR);
        }

        $stmt -> bindParam(":".$nameId, $id, PDO::PARAM_INT);

        if($stmt->execute()){
            return "ok";
        }else{
            return Conexion::conectar()->errorInfo();
        }

    }

    static public function mdlEliminarTarea($table, $id, $nameId){//Inventario Productos

        $stmt = Conexion::conectar()->prepare("DELETE FROM  $table WHERE $nameId = :$nameId");

        $stmt -> bindParam(":".$nameId, $id, PDO::PARAM_INT);
        
        if($stmt->execute()){
            return "ok";
        }else{
            return Conexion::conectar()->errorInfo();
        }
    }


}