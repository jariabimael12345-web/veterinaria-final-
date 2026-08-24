<?php

require_once("conexion.php");
require_once("Mascota.php");

class GuardarMascota extends Conexion{

    public function guardar(Mascota $m){

        $sql="INSERT INTO mascotas
        (nombre,especie,raza,edad,peso,color,responsable,telefono)
        VALUES
        (?,?,?,?,?,?,?,?)";

        $stmt=$this->conexion->prepare($sql);

        $stmt->execute([

            $m->getNombre(),
            $m->getEspecie(),
            $m->getRaza(),
            $m->getEdad(),
            $m->getPeso(),
            $m->getColor(),
            $m->getResponsable(),
            $m->getTelefono()

        ]);

        return true;

    }

}
?>