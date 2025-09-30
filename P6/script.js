function somar(){
    let valor_1 = Number(document.getElementById('valor_1').value)
    let valor_2 = Number(document.getElementById('valor_2').value)

    let soma = valor_1 + valor_2

    document.getElementById('resultado').textContent = "Resultado: " + soma;
    alert(soma)
}
function diminuir(){
    let valor_1 = Number(document.getElementById('valor_1').value)
    let valor_2 = Number(document.getElementById('valor_2').value)

    let diminui = valor_1 - valor_2

    document.getElementById('resultado').textContent = "Resultado: " + diminui;
}
function dividir(){
    let valor_1 = Number(document.getElementById('valor_1').value)
    let valor_2 = Number(document.getElementById('valor_2').value)

    let dividi = valor_1 / valor_2
    document.getElementById('resultado').textContent = "Resultado: " + dividi
    
}
function multiplicar(){
    let valor_1 = Number(document.getElementById('valor_1').value)
    let valor_2 = Number(document.getElementById('valor_2').value)
    

    let multiplica = valor_1 * valor_2
    document.getElementById('resultado').textContent = "Resultado: " + multiplica;

}
