<?php

class EstadoControlador{

    static public function ctrListarEstado(){
        $estado = EstadoModelo::mdlListarEstado();
        return $estado;
    }
}