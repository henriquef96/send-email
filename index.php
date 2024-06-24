<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="logo.png" type="image/x-icon">
    <title>Send Mail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');

        * {
            font-family: "Roboto", sans-serif;
        }

        body {
            background-image: url('./background.png');
            background-size: cover;
        }

        .container-fluid {
            background-color: rgb(83, 158, 230, 0.1);
            backdrop-filter: blur(15px);
        }

        .bg-mail {
            background-color: rgb(250, 250, 250, 0.7);
            border-radius: 6px;
        }

        .form-control {
            background-color: rgb(250, 250, 250, 0.1);
            border: transparent;
        }

        .form-control:focus {
            border: 1px solid #539EE6;
        }

        .btn {
            background-color: rgb(83, 158, 230, 0.9);
            border: none;
            color: #f3f3f3;
            transition: 0.3s;
        }

        .btn:hover {
            background-color: rgb(83, 158, 230);
            color: white;
            transform: scale(1.03);
        }

        @media (max-width: 575px) {
            .container-fluid {
                padding: 0;
            }

            .bg-mail {
                height: 100%;
                width: 100%;
                border-radius: 0;
            }
        }
    </style>
</head>

<body>
    <main class="container-fluid text-light vh-100 d-flex justify-content-center align-items-center">
        <div class="bg-mail p-5 text-dark shadow-lg">

            <div class="text-center">
                <img class="d-block mx-auto mb-2" src="logo.png" alt="logo" width="72" height="72">
                <h2>Send Mail</h2>
                <p class="lead">Seu app de envio de e-mails particular!</p>
            </div>

            <form action="envio.php" method="post">
                <div class="form-group">
                    <label for="para">Para</label>
                    <input name="para" type="text" class="form-control shadow-sm" id="para" placeholder="usuario@dominio.com.br">
                </div>

                <div class="form-group mt-3">
                    <label for="assunto">Assunto</label>
                    <input name="assunto" type="text" class="form-control shadow-sm" id="assunto" placeholder="Assundo do e-mail">
                </div>

                <div class="form-group mt-3">
                    <label for="mensagem">Mensagem</label>
                    <textarea name="mensagem" class="form-control shadow-sm" id="mensagem"></textarea>
                </div>

                <button type="submit" class="btn btn-primary shadow mt-3 w-100">Enviar Mensagem</button>
            </form>

        </div>
    </main>
</body>

</html>