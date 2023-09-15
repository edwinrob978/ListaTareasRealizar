<?php

class TareasControlador{

   static public function ctrTareasListar(){
        
      $tareasListar = TareasModelo::mdlGetTareasListar();

      return $tareasListar;

   }

  static public function ctrRegistrarTarea($nombre_tarea, $descripcion_tarea, $id_estado){

        $registroTarea = TareasModelo::mdlRegistrarTarea($nombre_tarea, $descripcion_tarea, $id_estado);

        return $registroTarea;
    }

   static public function ctrActualizarTareas($table, $data, $id, $nameId){
        
      $respuesta = TareasModelo::mdlActualizarTareas($table, $data, $id, $nameId);

      return $respuesta;
   }

   static public function ctrEliminarTarea($table, $id, $nameId){
        
      $respuesta = TareasModelo::mdlEliminarTarea($table, $id, $nameId);

      return $respuesta;
   }


}