document.addEventListener('DOMContentLoaded', function () {
    // Função para aplicar a máscara de telefone
    function aplicarMascaraTelefone(telefone) {
        telefone = telefone.replace(/\D/g, '');

        if (telefone.length <= 10) {
            telefone = telefone.replace(/(\d{2})(\d{4})(\d{4})/, '($1) $2-$3');
        } else {
            telefone = telefone.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
        }

        return telefone;
    }

    // Função para validar o telefone
    function validarTelefone(telefone) {
        const telefoneLimpo = telefone.replace(/\D/g, '');
        return telefoneLimpo.length >= 10;
    }

    // Função para validar campos obrigatórios
    function validarCampos() {
        const nome = document.querySelector('[name="nome"]');
        const cpf = document.querySelector('[name="cpf"]');
        const email = document.querySelector('[name="email"]');
        const telefone = document.querySelector('[name="telefone"]');
        const comentario = document.querySelector('[name="comentario"]');
        const evidencia = document.querySelector('[name="evidencia"]');
        let mensagensErro = [];

        if (nome.value.trim() === "") mensagensErro.push("Nome");
        if (cpf.value.trim() === "") mensagensErro.push("CPF");
        if (email.value.trim() === "") mensagensErro.push("E-mail");
        if (telefone.value.trim() === "") mensagensErro.push("Telefone");
        if (comentario.value.trim() === "") mensagensErro.push("Comentários");
        if (evidencia.files.length === 0) mensagensErro.push("Evidência");

        return mensagensErro;
    }

    // Aplica a máscara ao telefone enquanto o usuário digita
    document.getElementById('telefone').addEventListener('input', function () {
        const telefone = this.value;
        this.value = aplicarMascaraTelefone(telefone);
    });

    // Valida o telefone antes de enviar o formulário
    document.querySelector('form').addEventListener('submit', function (event) {

        // Valida outros campos
        const erros = validarCampos();
        if (erros.length > 0) {
            event.preventDefault();  // Impede o envio do formulário
            Swal.fire({
                title: 'ERRO!',
                text: 'Por favor, preencha os seguintes campos obrigatórios: ' + erros.join(", "),
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return;
        }

        const telefone = document.getElementById('telefone').value;

        if (!validarTelefone(telefone)) {
            event.preventDefault();  // Impede o envio do formulário
            Swal.fire({
                title: 'ERRO!',
                text: 'O número de telefone deve ter pelo menos 10 dígitos.',
                icon: 'error',
                confirmButtonText: 'OK'
            });

            return;
        }
    });
});