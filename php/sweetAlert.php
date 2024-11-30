<?php
function chamaSweetAlert($resultadoOperacao, $text, $page) {
    if ($resultadoOperacao) {
        echo "
            <script>
                Swal.fire({
                    title: 'Sucesso!',
                    text: '$text',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location.href = '../../$page';
                });
            </script>";
    
    } else {
        echo "
            <script>
                Swal.fire({
                    title: 'ERRO!',
                    text: '$text',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location.href = '../../$page';
                });
            </script>"; 
    }
}