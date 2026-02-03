<?php

class Automovel {
    public $marca;
    public $nome;
    public $modelo;
    public $velocidade;

    function __construct(string $marca, string $nome, string $modelo, float $velocidade)
    {
        $this->marca = $marca;
        $this->nome = $nome;
        $this->modelo = $modelo;
        $this->velocidade = $velocidade;
    }

    function andar()
    {
        echo "{$this->marca} {$this->nome} {$this->modelo} está andando a {$this->velocidade} km/h\n";
    }
}

// Criando objetos da classe Automovel
$carro = new Automovel("Toyota", "Corolla", "Sedan", 120);
$carro->andar();

$moto = new Automovel("Honda", "CB500", "Street", 90);
$moto->andar();

$onibus = new Automovel("Mercedes", "Tourismo", "Rodoviário", 80);
$onibus->andar();

?>
