function cadastrar() {
    const usuario = document.getElementById('usuario').value
    const senha = document.getElementById('senha').value
    const confirmarSenha = document.getElementById('confirmarSenha').value

    if(usuario && senha === confirmarSenha){
        localStorage.setItem(usuario,senha)
        return alert (`Usuario ${usuario} cadastrado com sucesso`)

    }
    else {
        return alert ("Usuário e/ou senha incorretos")
    }
}

function login(){
    const usuario = document.getElementById('usuario').value
    const senha = document.getElementById('senha').value
    
    let usuarioExistente = localStorage.getItem(usuario)

if(!usuarioExistente){
    return alert ("Usuário não existe")
}
if(usuario && senha === usuarioExistente){
    localStorage.setItem(usuario,senha)
    alert(`Usuário ${usuario} logado com sucesso`)
    window.location.href = "entrar.html"
}

else{
    return alert ("tem algo errado com a senha ou com o usuario")
}
}
function entrar(){
  window.location.href = "./entrar.html"
}