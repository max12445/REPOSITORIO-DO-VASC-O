// const x = 10

// const alunos = ["max", "japa", "satan"]



// console.log(alunos)

// function somar(n1, n2){
//     return n1 + n2
// }


// function bomdia(nome){

//     return "bomdia meu querido(a)" + nome
// }

// console.log(somar(10,5))
// console.log(somar(12,7))
// console.log(bomdia("MAX"))
// // segunda parte da aula 
  
// let titulo = document.getElementById("titulo")

// titulo.innerHTML = "Alterando o texto pelo JavaScript"

// console.log(titulo.innerHTML)

function SomarNumeros(){
    let n1 = Number(document.getElementById("n1").value)
    let n2 = Number(document.getElementById("n2").value)
    alert(n1 + n2)
}
function DiminuirNumeros(){
    let n1 = Number(document.getElementById("n1").value)
    let n2 = Number(document.getElementById("n2").value)
    alert(n1 - n2)
}
function MultiplicarNumeros(){
    let n1 = Number(document.getElementById("n1").value)
    let n2 = Number(document.getElementById("n2").value)
    alert(n1 * n2)
}
function DividirNumeros(){
    let n1 = Number(document.getElementById("n1").value)
    let n2 = Number(document.getElementById("n2").value)
    alert(n1 / n2)
}