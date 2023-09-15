<?php

require_once "../controladores/estado.controlador.php";
require_once "../modelo/estado.modelo.php";

class AjaxEstado{

    public function ajaxListarEstado(){
        $estado = EstadoControlador::ctrListarEstado();
        echo json_encode($estado, JSON_UNESCAPED_UNICODE);
    }
}

$estado = new AjaxEstado();
$estado -> ajaxListarEstado();