<?php

class Mascota{

    protected $nombre;
    protected $especie;
    protected $raza;
    protected $edad;
    protected $peso;
    protected $color;
    protected $responsable;
    protected $telefono;

    public function __construct($nombre,$especie,$raza,$edad,$peso,$color,$responsable,$telefono){

        $this->nombre=$nombre;
        $this->especie=$especie;
        $this->raza=$raza;
        $this->edad=$edad;
        $this->peso=$peso;
        $this->color=$color;
        $this->responsable=$responsable;
        $this->telefono=$telefono;

    }

    public function getNombre(){ return $this->nombre; }
    public function getEspecie(){ return $this->especie; }
    public function getRaza(){ return $this->raza; }
    public function getEdad(){ return $this->edad; }
    public function getPeso(){ return $this->peso; }
    public function getColor(){ return $this->color; }
    public function getResponsable(){ return $this->responsable; }
    public function getTelefono(){ return $this->telefono; }

    public function setPeso($peso){

        if(is_numeric($peso) && $peso>0){

            $this->peso=$peso;

        }else{

            throw new Exception("Peso incorrecto");

        }

    }

}
?>