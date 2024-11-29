document.addEventListener('DOMContentLoaded', function () {
    function inputHandler(masks, max, event) {
        var c = event.target;
        var v = c.value.replace(/\D/g, '');
        var m = c.value.length > max ? 1 : 0;
        VMasker(c).unMask();
        VMasker(c).maskPattern(masks[m]);
        c.value = VMasker.toPattern(v, masks[m]);
    }

    //TELEFONE
    var mascaraTelefone = ['(99) 9999-99999', '(99) 99999-9999'];
    var telefone = document.querySelector('#telefone');
    if (telefone != null) {
        VMasker(telefone).maskPattern(mascaraTelefone[0]);
        telefone.addEventListener('input', inputHandler.bind(undefined, mascaraTelefone, 14), false);
    }
    
    //CPF/CNPJ
    var mascaraCpfCnpj = ['999.999.999-99', '99.999.999/9999-99'];
    var cpfCnpj = document.querySelector('#cpfCnpj');
    if (cpfCnpj != null) {
        VMasker(cpfCnpj).maskPattern(mascaraCpfCnpj[0]);
        cpfCnpj.addEventListener('input', inputHandler.bind(undefined, mascaraCpfCnpj, 14), false);
    }

    //CPF
    var mascaraCpf = ['999.999.999-99'];
    var cpf = document.querySelector('#cpf');
    if (cpf != null) {
        VMasker(cpf).maskPattern(mascaraCpf[0]);
        cpf.addEventListener('input', inputHandler.bind(undefined, mascaraCpf, 14), false);
    }

});