<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>404 - Página Não Encontrada</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/404.css">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="icon" type="image/x-icon" href="./images/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</head>

<body>
    <header class="cabecalho">
        <?php
        include 'components/header.php';
        ?>
    </header>

    <!-- <section class="conteudo_erro">
        <div class="container_conteudo_erro">
            <h1 class="titulo">OPS! <BR>PÁGINA NÃO ENCONTRADA</h1>
            <p class="mensagem_erro">A página que você está procurando não foi encontrada. <BR>Mas não se preocupe, nós
                podemos te ajudar a voltar ao início!</p>
            <button class="botao_1">
                <a href="home">VOLTAR PARA A PÁGINA INICIAL</a>
            </button>
        </div>
</section> -->


    <section class="conteudo_principal">
        <div class="container_conteudo_erro">
            <h1 class="titulo">OPS! <BR>PÁGINA NÃO ENCONTRADA</h1>
            <p class="mensagem_erro">A página que você está procurando não foi encontrada. <BR>Mas não se preocupe, nós
            podemos te ajudar a voltar ao início!</p>
            <button class="botao_1">
                <a href="index.php">SAIBA MAIS</a>
            </button>
        </div>
    </section>


    <!-- <footer class="rodape">
        <?php
        // include 'components/footer.php';
        ?>
    </footer> -->

</body>

</html>