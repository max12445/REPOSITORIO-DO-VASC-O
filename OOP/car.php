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

$carro = new Automovel("Toyota", "Corolla", "Sedan", 120);
$carro->andar();

$moto = new Automovel("Honda", "CB500", "Street", 90);
$moto->andar();

$onibus = new Automovel("Mercedes", "Tourismo", "Rodoviário", 80);
$onibus->andar();

?>

<!--  -->

<?php

class Animal {
    public $raca;
    public $nome;
    public $peso;
    public $altura;

    function __construct(string $raca, string $nome, string $peso, float $altura)
    {
        $this->raca = $raca;
        $this->nome = $nome;
        $this->modelo = $modelo;
        $this->altura = $altura;
    }

    function andar()
    {
        echo "{$this->raca} {$this->nome} {$this->peso} e possui {$this->altura} de\n";
    }
}

$carro = new Automovel("cachorro", "Corolla", "Sedan", 120);
$carro->andar();

$moto = new Automovel("hiena", "CB500", "Street", 90);
$moto->andar();

$onibus = new Automovel("tatuarana", "Tourismo", "Rodoviário", 80);
$onibus->andar();

?>

<!--  -->

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

$carro = new Automovel("Toyota", "Corolla", "Sedan", 120);
$carro->andar();

$moto = new Automovel("Honda", "CB500", "Street", 90);
$moto->andar();

$onibus = new Automovel("Mercedes", "Tourismo", "Rodoviário", 80);
$onibus->andar();

?>
