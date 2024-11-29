import * as regras from './regrasValidacao.js';

document.addEventListener('DOMContentLoaded', function () {
    document.querySelector('form').addEventListener('submit', function (event) {

        const email = document.querySelector('#email').value;
        const cpf = document.querySelector('#cpf').value;
        const telefone = document.querySelector('#telefone').value;
        
        const mensagemErro = regras.validaCamposObrigatoriosCadastro();
        if (mensagemErro.length > 0) {
            regras.alertarErro('Por favor, preencha os seguintes campos obrigatórios: ' + mensagemErro.join(", "));
            return;
        }

        if (regras.validaCpf(cpf) == false) {
            regras.alertarErro("O CPF deve conter 11 dígitos no seguinte formato: xxx.xxx.xxx-xx");
            return;
        }

        if (regras.validaEmail(email) == false) {
            regras.alertarErro("O E-mail preenchido é inválido.");
            return;
        }

        if (regras.validaTelefone(telefone) == false) {
            regras.alertarErro("O número de telefone deve conter de 10 a 11 dígitos.");
            return;
        }

    });
});