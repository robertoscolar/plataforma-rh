<?php
function chamaSweetAlert($resultadoOperacao) {
    if ($resultadoOperacao) {
        echo "
            <script>
                Swal.fire({
                    title: 'Sucesso!',
                    text: 'Formulário processado com sucesso. Cheque sua caixa de e-mail!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location.href = '../../index.php';
                });
            </script>";
    
    } else {
        echo "
            <script>
                Swal.fire({
                    title: 'ERRO!',
                    text: 'Erro ao processar formulário. Tente novamente!',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location.href = '../../cadastro.php';
                });
            </script>"; 
    }
}