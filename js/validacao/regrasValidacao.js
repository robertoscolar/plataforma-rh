// Função para validar o telefone - com máscara
export function validaTelefone(telefone) {    
    const regex = /^\(\d{2}\) \d{4,5}-\d{4}$/;
    
    if (telefone.length == 14) {
        return true;

    } else if (telefone.length == 15) {
        return true;
    
    } else if (regex.test(telefone)) {
        return true;
    }
        
    return false;
}

//Função para validar e-mail
export function validaEmail(email) {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(email);
}

// Função para validar CPF - com máscara
export function validaCpf(cpf) {
    const regex = /^\d{3}\.\d{3}\.\d{3}-\d{2}$/;

    if (cpf.length == 14) {
        return true;
    
    } else if (regex.test(cpf)) {
        return true;
    }

    return false;
}

// Função para validar CNPJ - com máscara
export function validaCnpj(cnpj) {
    const regex = /^\d{2}\.\d{3}\.\d{3}\/\d{4}-\d{2}$/;

    if (cnpj.length == 18) {
        return true;
    
    } else if (regex.test(cnpj)) {
        return true;
    }

    return false;
}

// Função para validar campos obrigatórios
export function validaCamposObrigatoriosCadastro() {
    var mensagemErro = [];

    const nome = document.querySelector('[name="nome"]');
    const cpf = document.querySelector('[name="cpf"]');
    const email = document.querySelector('[name="email"]');
    const telefone = document.querySelector('[name="telefone"]');
    const comentario = document.querySelector('[name="comentario"]');
    const curriculo = document.querySelector('[name="curriculo"]');

    if (nome.value.trim() === "") mensagemErro.push("Nome");
    if (cpf.value.trim() === "") mensagemErro.push("CPF");
    if (email.value.trim() === "") mensagemErro.push("E-mail");
    if (telefone.value.trim() === "") mensagemErro.push("Telefone");
    if (comentario.value.trim() === "") mensagemErro.push("Comentários");
    if (curriculo.files.length === 0) mensagemErro.push("Currículo");

    return mensagemErro;
}

// Função para validar campos obrigatórios
export function validaCamposObrigatoriosContato() {
    var mensagemErro = [];

    const nome = document.querySelector('[name="nome"]');
    const cpfCnpj = document.querySelector('[name="cpfCnpj"]');
    const email = document.querySelector('[name="email"]');
    const comentario = document.querySelector('[name="comentario"]');
        
    if (nome.value.trim() === "") mensagemErro.push("Nome");
    if (cpfCnpj.value.trim() === "") mensagemErro.push("CPF/CNPJ");
    if (email.value.trim() === "") mensagemErro.push("E-mail");
    if (comentario.value.trim() === "") mensagemErro.push("Comentários");

    return mensagemErro;
}

// Função para notificar erro no formulário
export function alertarErro(mensagemErro) {
    event.preventDefault();
    Swal.fire({
        title: 'ERRO!',
        text: mensagemErro,
        icon: 'error',
        confirmButtonText: 'OK'
    });
}
