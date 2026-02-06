<?php

abstract class Produto
{
    protected string $nome;
    protected float $preco;
    protected int $quantidade;

    public function __construct(string $nome, float $preco, int $quantidade)
    {
        $this->nome = $nome;
        $this->preco = $preco;
        $this->quantidade = $quantidade;
    }

    abstract public function tipo(): string;

    public function info(): void
    {
        echo "Produto: {$this->nome}<br>";
        echo "Tipo: " . $this->tipo() . "<br>";
        echo "Preço: R$ " . $this->preco . "<br>";
        echo "Estoque: {$this->quantidade}<br>";
    }

    public function menosEstoque(int $qtde): void
    {
        $this->quantidade -= $qtde;
    }

    public function valor(): float
    {
        return $this->preco;
    }
    public function getQuantidade(): int
    {
        return $this->quantidade;
    }
}

// Produtos
class Calca extends Produto
{
    public function tipo(): string
    {
        return "Calça";
    }
}
class Jaqueta extends Produto
{
    public function tipo(): string
    {
        return "Jaqueta";
    }
}
class Meia extends Produto
{
    public function tipo(): string
    {
        return "Meia";
    }
}

abstract class Cliente
{
    protected string $nome;
    protected string $id;

    public function __construct(string $nome, string $id)
    {
        $this->nome = $nome;
        $this->id = $id;
    }

    abstract public function desconto(): float;

    public function info(): void
    {
        echo "Cliente: {$this->nome} / id: {$this->id}<br>";
        echo "Desconto: " . ($this->desconto() * 100) . "%<br>";
    }
}

class ClienteComum extends Cliente
{
    public function desconto(): float
    {
        return 0.00;
    }
}
class ClientePremium extends Cliente
{
    public function desconto(): float
    {
        return 0.15;
    }
}

class Pedido
{
    const aberto = 'aberto';
    const pago = 'pago';
    const enviado = 'enviado';
    const cancelado = 'cancelado';


    private Cliente $cliente;
    private array $itens;
    private float $totalBruto;
    private float $totalLiquido;
    private string $status;

    public function __construct(string $id, Cliente $cliente)
    {

        $this->cliente = $cliente;
        $this->itens = [];
        $this->totalBruto = 0.0;
        $this->totalLiquido = 0.0;
        $this->status = self::aberto;
    }

    public function adicionarItem(Produto $p, int $qtde): void
    {
        if ($this->status !== self::aberto)
            throw new ("Pedido não está aberto");

        if ($qtde > $p->getQuantidade())
            throw new ("Estoque insuficiente");

        $this->itens[] = ['produto' => $p, 'quantidade' => $qtde];
        $this->totalBruto += $p->valor() * $qtde;
        $this->aplicarDesconto();
    }

    private function aplicarDesconto(): void
    {
        $this->totalLiquido = $this->totalBruto * (1 - $this->cliente->desconto());
    }


    public function cancelar(): void
    {
        $this->status = self::cancelado;
    }
    public function enviar(): void
    {
        if ($this->status === self::pago) $this->status = self::enviado;
    }

    public function resumo(): void
    {
        echo "Status: {$this->status}<br>";
        $this->cliente->info();
        foreach ($this->itens as $i) {
            $sub = $i['produto']->valor() * $i['quantidade'];
            echo $i['produto']->tipo() . ": {$i['quantidade']} x R$ " .
                number_format($i['produto']->valor(), 2,) . "= R$ " .
                number_format($sub, 2,) . "<br>";
        }
        echo "Total Bruto: R$" . number_format($this->totalBruto, 2) . "<br>";
        echo "Total Líquido: R$" . number_format($this->totalLiquido, 2) . "<br>";
    }
}

$calca = new Calca("Calça Jeans", 249.99, 10);
$jaqueta = new Jaqueta("Jaqueta Couro", 379.99, 5);
$meia = new Meia("Meia", 20.99, 30);

$cliComum = new ClienteComum("Nicolas", "C01");
$cliPremium = new ClientePremium("Fernandinho ", "C02");

$pedido1 = new Pedido("P01", $cliComum);
$pedido1->adicionarItem($calca, 2);
$pedido1->adicionarItem($meia, 5);
$pedido1->resumo();

echo ("<br>");

$pedido2 = new Pedido("P02", $cliPremium);
$pedido2->adicionarItem($jaqueta, 1);
$pedido2->adicionarItem($meia, 8);
$pedido2->cancelar();
$pedido2->resumo();
