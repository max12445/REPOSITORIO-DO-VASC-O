<?php

abstract class Animal {
    protected string $nome;
    protected int $idade;

    public function __construct(string $nome, int $idade) {
        $this->nome  = $nome;
        $this->idade = $idade;
    }

    abstract public function tipo(): string;

    public function info(): void {
        echo "Nome: {$this->nome}<br>";
        echo "Idade: {$this->idade} anos<br>";
        echo "Tipo: {$this->tipo()}<br><br>";
    }
}

class Cachorro extends Animal {
    public function tipo(): string {
        return "Cachorro";
    }

    public function latir(): void {
        echo "{$this->nome} diz: Au Au!<br>";
    }
}

class Gato extends Animal {
    public function tipo(): string {
        return "Gato";
    }

    public function miar(): void {
        echo "{$this->nome} diz: Miau!<br>";
    }
}

class Mamifero {
    protected Cachorro $cachorro;
    protected Gato $gato;

    public function __construct(Cachorro $cachorro, Gato $gato) {
        $this->cachorro = $cachorro;
        $this->gato     = $gato;
    }

    public function mostrarAnimais(): void {
        echo "=== Mamíferos ===<br>";
        $this->cachorro->info();
        $this->gato->info();
    }


}

// objetos
$cachorro = new Cachorro("Rex", 5);
$gato     = new Gato("Mimi", 3);

$mamifero = new Mamifero($cachorro, $gato);

// usando os métodos
$cachorro->info();
$cachorro->latir();

echo "<hr>";

$gato->info();
$gato->miar();

echo "<hr>";

$mamifero->mostrarAnimais();


?>
