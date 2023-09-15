<?php

require_once "../controladores/tarea.controlador.php";
require_once "../modelo/tarea.modelo.php";
require_once "../vendor/autoload.php";

class ajaxTareas{

    public $nombre_tarea;
    public $descripcion_tarea;
    public $id_estado;



    public function ajaxTareasListar()
    {
        $tareasListar = TareasControlador::ctrTareasListar();
        echo json_encode($tareasListar);
    }

    public function ajaxRegistrarTarea(){
        
        $tarea = TareasControlador::ctrRegistrarTarea($this->nombre_tarea, $this->descripcion_tarea,$this->id_estado);

        echo json_encode($tarea);
    }

    public function ajaxActualizarTareas($data){
        
        $table = "tareas";
        $id = $_POST["id"];
        $nameId = "id";

        $respuesta = TareasControlador::ctrActualizarTareas($table, $data, $id, $nameId);
     
        echo json_encode($respuesta);
        
    }

    public function ajaxEliminarTarea( ){
        
        $table = "tareas";
        $id = $_POST["id"];
        $nameId = "id";
        
        $respuesta = TareasControlador::ctrEliminarTarea($table, $id, $nameId);
     
        echo json_encode($respuesta);

    }

}

if (isset($_POST['accion']) && ($_POST['accion']) == 1) {//listar tareas

    $tareasListar = new ajaxTareas();
    $tareasListar->ajaxTareasListar();

}else if (isset($_POST['accion']) && ($_POST['accion']) == 2) {//Registrar productos inventario

    $registrarTarea = new ajaxTareas();
    $registrarTarea -> nombre_tarea = $_POST["nombre_tarea"];
    $registrarTarea -> descripcion_tarea = $_POST["descripcion_tarea"];
    $registrarTarea -> id_estado = $_POST["id_estado"];
    $registrarTarea -> ajaxRegistrarTarea();

}else if (isset($_POST['accion']) && ($_POST['accion']) == 4) {//Actualizar productos inventario

    $actualizarTareas = new ajaxTareas();
    
    $data = array(
        "nombre_tarea" => $_POST["nombre_tarea"],
        "descripcion_tarea" => $_POST["descripcion_tarea"],
        "id_estado" => $_POST["id_estado"]
    );

    $actualizarTareas -> ajaxActualizarTareas($data);

}else if (isset($_POST['accion']) && ($_POST['accion']) == 5) {//ELIMINAR TAREA

    $eliminarTarea = new ajaxTareas();
    $eliminarTarea -> ajaxEliminarTarea();

}