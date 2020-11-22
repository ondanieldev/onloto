<?php
    session_start();
    require_once('./database/tables.php');
    require_once('./integration.php')
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/global.css"></link>
    <link rel="stylesheet" href="./css/logo.css"></link>
    <link rel="stylesheet" href="./css/aside.css"></link>
    <link rel="stylesheet" href="./css/header.css"></link>
    <link rel="stylesheet" href="./css/main.css"></link>
    <link rel="stylesheet" href="./css/new.css"></link>
    <link rel="stylesheet" href="./css/profile.css"></link>
    <link rel="stylesheet" href="./css/saved.css"></link>
    <link rel="stylesheet" href="./css/login.css"></link>
    <link rel="stylesheet" href="./css/clues.css"></link>
    <link rel="stylesheet" href="./css/downloads.css"></link>
    <title>Lotofácil Dominante</title>
</head>
<body>

<?php if(isset($_SESSION["login"]) and $_SESSION["login"] === true){ ?>

    <div id="onl-app">

        <aside id="onl-logo">
            <div>
                <i onclick="toggleDrawer()" class="fa fa-bars"></i>
                <img src="./img/logo.png" alt="logo">
            </div>
        </aside>

        <aside id="onl-aside">
            <ul>
                <a href="?section=new" class="">
                    <li><i class="fa fa-plus"></i><span>Criar jogo<span></li>
                </a>
                <a href="?section=saved">
                    <li><i class="fa fa-save"></i><span>Jogos salvos<span></li>
                </a>
                <?php if($_SESSION["id"] == 1){ ?>
                    <a href="?section=clues">
                        <li><i class="fa fa-cog"></i><span>Configurar dicas<span></li>
                    </a>
                <?php } ?>
                <a href="?section=downloads">
                    <li><i class="fa fa-download"></i><span>Downloads<span></li>
                </a>
                <a href="./functions/logout.php">
                    <li><i class="fa fa-sign-out"></i><span>Sair<span></li>
                </a>
            </ul>
        </aside>

        <header id="onl-header">
                <div>
                    <b><?php echo $_SESSION["name"]; ?></b>
                    <span>Seja bem vindo!</span>
                </div>
                <a href="?section=profile"><i class="fa fa-cog"></i></a>
        </header>

        <main id="onl-main">
            <?php
                if(isset($_GET['section'])){
                    $section = $_GET['section'];
                    if($section == 'new') require './pages/new.php';
                    else if($section == 'profile') require './pages/profile.php';
                    else if($section == 'saved') require './pages/saved.php';
                    else if($section == 'clues') require './pages/clues.php';
                    else if($section == 'downloads') require './pages/downloads.php';
                    else require './pages/new.php';
                }else{
                    require './pages/new.php';
                }
            ?>
        </main>

    </div>

<?php }else{ ?>

    <div id="onl-login">
        <div class="login-container">
            <div class="login-title">
                <img src="./img/logo.png" alt="logo">
            </div>
            <div class="login-input-group">
                <input type="text" name="email" placeholder="E-mail" autocomplete="off" required>
                <input type="password" name="password" placeholder="Senha" required>
            </div>
            <div class="login-button-group">
                <input onclick="login()" type="submit" name="login" value="Entrar">
            </div>
        </div>
    </div>

<?php } ?>

</body>

<script>

    const ajaxLogin = (config) => {
        const xhr = new XMLHttpRequest()

        xhr.onreadystatechange = function() {
            if(xhr.readyState == XMLHttpRequest.DONE){
                const {status, message} = JSON.parse(xhr.response)
                if(status==="error") showAlert(status, message)
                else if(status==="success") location.reload()
            }
        }

        xhr.open(config.method, config.url, true)
        xhr.send(config.formData)
    }

    const login = (gameId) => {
        const formData = new FormData()
        const email = document.querySelector("input[name=email]").value
        const password = document.querySelector("input[name=password]").value
        formData.append('email', email)
        formData.append('password', password)
        ajaxLogin({
            method: "post",
            url: "./functions/login.php",
            formData
        })
    }

    const toggleDrawer = () => {
        const drawer = document.querySelector("#onl-aside")
        if(drawer.style.visibility == "hidden"){
            drawer.style.visibility = "visible"
            drawer.style.display = "flex"
            drawer.style.width = "270px"
        }else{
            drawer.style.visibility = "hidden"
            drawer.style.display = "none"
        }
    }

    const showAlert = (status, message) => {
        const body = document.querySelector('body')

        const alert = document.createElement('div')
        alert.classList.add('alert')

        if(status === 'success') alert.classList.add('alert-success')
        else if(status === 'error') alert.classList.add('alert-error')

        const alertMessage = document.createElement('p')
        alertMessage.classList.add('alert-message')
        alertMessage.innerHTML = message

        alert.appendChild(alertMessage)
        body.appendChild(alert)

        setTimeout(() => {
            alertMessage.remove()
            alert.remove()
        }, 3000);
    }
</script>

</html>