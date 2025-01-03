<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Construtech Recrutamento</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/cadastro.css">
    <link rel="stylesheet" href="css/reset.css">
    <script src="https://unpkg.com/vanilla-masker@1.1.1/build/vanilla-masker.min.js"></script>
    <script src="js/mascara.js"></script>
    <script type="module" src="js/validacao/validaFormCadastro.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/x-icon" href="./images/favicon.ico">
    <script src="js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

    <section class="conteudo_principal">
    <a href="https://api.whatsapp.com/send?phone=5511915189377&text=Olá!" 
   class="whatsapp-float" 
   target="_blank">
   <span class="whatsapp-hover-text">Deseja um atendimento <BR> personalizado?<BR> Chame a gente no Whats!</span>
   <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp" class="whatsapp-icon">
</a>
        <h1>SEJA PARTE DE NOSSO TIME!</h1>
        <div class="form_explicativo">
            <div class="conteiner_explicativo">
                <!-- <h1>Dê o primeiro passo para sua próxima grande oportunidade!</h1> -->
                <p class="img_cadastro">Estamos sempre em busca de pessoas talentosas e apaixonadas pelo que fazem.<BR> Se
                    você quer crescer, aprender e contribuir com sua experiência, essa é a sua chance.<BR> Preencha seu
                    currículo e mostre como você pode fazer a diferença aqui!</p>
                <div class="img"></div>
            </div>
            <div class="container_cadastro">
                <h2 class="legenda_principal">Preencha os dados abaixo</h2>
                <p class="legenda_secundaria">* Lembre-se de que todos os campos são obrigatórios</p>
                <form action="php/action/cadastroCurriculo.php" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col">
                            <input type="text" class="form-control" placeholder="Nome Completo" aria-label="Nome"
                                name="nome" maxlength="100">
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" placeholder="CPF" aria-label="CPF" maxlength="14"
                                name="cpf" id="cpf">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <input type="text" id="email" class="form-control" placeholder="E-mail" aria-label="E-mail"
                                maxlength="255" name="email">
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" placeholder="Telefone" aria-label="Telefone"
                                maxlength="15" minlength="14" id="telefone" name="telefone">
                        </div>
                    </div>

                    <!-- QUEM SABE DEPOIS -->
                    <!--
            <div class="row">
                <div class="col">
                    <select class="form-select" id="getEstado" >
                        <option selected>Choose...</option>
                    </select>
                </div>
                <div class="col">
                    <select class="form-select" id="getCidade"  disabled>
                        <option selected>Choose...</option>
                    </select>
                </div>
            </div>
            -->

                    <textarea class="form-control" style="margin-bottom: 15px;" rows="3" placeholder="Comentários..."
                        maxlength="1000" name="comentario"></textarea>

                    <div class="mb-3">
                        <label for="curriculo" class="form-label">Currículo (somente .pdf):</label>
                        <input class="form-control" type="file" id="curriculo" accept="application/pdf"
                            name="curriculo">
                    </div>
                    <div class="botao-container">
                        <button class="botao_1" type="submit">Cadastrar</button>
                        <button class="botao_1" type="reset">Limpar</button>
                    </div>
                </form>
            </div>


        </div>


    </section>


    <footer class="rodape">
        <?php
        include 'components/footer.php';
        ?>
    </footer>

</body>

</html>