<?php

require_once("conexion.php");

class ListarMascotas extends Conexion{

    public function contar(){

        $sql = "SELECT COUNT(*) AS total FROM mascotas";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();

        $fila = $stmt->fetch(PDO::FETCH_ASSOC);

        return (int) $fila['total'];

    }

    public function listar($pagina = 1, $porPagina = 5){

        if($pagina < 1){
            $pagina = 1;
        }

        $offset = ($pagina - 1) * $porPagina;

        $sql = "SELECT id,nombre,especie,raza,edad,peso,color,responsable,telefono
                FROM mascotas
                ORDER BY id DESC
                LIMIT :porPagina OFFSET :offset";

        $stmt = $this->conexion->prepare($sql);

        $stmt->bindValue(":porPagina", (int) $porPagina, PDO::PARAM_INT);
        $stmt->bindValue(":offset", (int) $offset, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

}
?>
