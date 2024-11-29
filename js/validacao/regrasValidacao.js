// Função para validar o telefone - com máscara
export function validaTelefone(telefone) {    
    if (telefone.length == 14) {
        return true;

    } else if (telefone.length == 15) {
        return true;
    }
        
    return false;
}

// Função para validar CPF - com máscara
export function validaCpf(cpf) {
    if (cpf.length == 14) {
        return true;
    }

    return false;
}

// Função para validar CNPJ - com máscara
export function validaCnpj(cnpj) {
    if (cnpj.length == 18) {
        return true;
    }


    return false;
}

// Função para validar campos obrigatórios
export function validaCamposObrigatorios_CADASTRO_ADAPTAR_DEPOIS() {
    var mensagemErro = [];

    const nome = document.querySelector('[name="nome"]');
    const cpf = document.querySelector('[name="cpf"]');
    const email = document.querySelector('[name="email"]');
    const telefone = document.querySelector('[name="telefone"]');
    const comentario = document.querySelector('[name="comentario"]');
    const curriculo = document.querySelector('[name="curriculo"]');
    let mensagensErro = [];

    if (nome.value.trim() === "") mensagensErro.push("Nome");
    if (cpf.value.trim() === "") mensagensErro.push("CPF");
    if (email.value.trim() === "") mensagensErro.push("E-mail");
    if (telefone.value.trim() === "") mensagensErro.push("Telefone");
    if (comentario.value.trim() === "") mensagensErro.push("Comentários");
    if (curriculo.files.length === 0) mensagensErro.push("Currículo");

    return mensagensErro;
}

// Função para validar campos obrigatórios
export function validaCamposObrigatorios_CONTATO_ADAPTAR_DEPOIS() {
    var mensagemErro = [];

    const nome = document.querySelector('[name="nome"]');
    const cpf = document.querySelector('[name="cpf"]');
    const email = document.querySelector('[name="email"]');
    const telefone = document.querySelector('[name="telefone"]');
    const comentario = document.querySelector('[name="comentario"]');
    const curriculo = document.querySelector('[name="curriculo"]');
    let mensagensErro = [];

    if (nome.value.trim() === "") mensagensErro.push("Nome");
    if (cpf.value.trim() === "") mensagensErro.push("CPF");
    if (email.value.trim() === "") mensagensErro.push("E-mail");
    if (telefone.value.trim() === "") mensagensErro.push("Telefone");
    if (comentario.value.trim() === "") mensagensErro.push("Comentários");
    if (curriculo.files.length === 0) mensagensErro.push("Currículo");

    return mensagensErro;
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
