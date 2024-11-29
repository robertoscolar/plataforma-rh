import * as regras from './regrasValidacao.js';

document.addEventListener('DOMContentLoaded', function () {
    document.querySelector('form').addEventListener('submit', function (event) {

        // const cpfCnpj = document.querySelector('#cpfCnpj').value;
        // const telefone = document.querySelector('#telefone').value;

        const mensagemErro = regras.validaCamposObrigatorios_CONTATO_ADAPTAR_DEPOIS();
        if (mensagemErro.length > 0) {
            regras.alertarErro('Por favor, preencha os seguintes campos obrigatórios: ' + mensagemErro.join(", "));
            return;
        }

        if (regras.validaCpf(cpfCnpj) == false && regras.validaCnpj(cpfCnpj)) {
            regras.alertarErro("O CPF/CNPJ deve conter 11 ou 14 dígitos.");
            return;
        }

        if (regras.validaTelefone(telefone) == false) {
            regras.alertarErro("O número de telefone deve conter de 10 a 11 dígitos.");
            return;
        }

    });
});