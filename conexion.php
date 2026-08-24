<?php

class Conexion{

    protected $conexion;

    public function __construct(){

        try{

            $this->conexion = new PDO(
                "mysql:host=localhost;dbname=bd_santuario",
                "root",
                ""
            );

            $this->conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        }catch(PDOException $e){

            die("Error de conexión: ".$e->getMessage());

        }

    }

}
?>