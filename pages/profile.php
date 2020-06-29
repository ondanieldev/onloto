<div class="title-container">
    <h1 class="title"><div>P</div>erfil</h1>
    <hr>
</div>

<div class="container profile-container">
    <div class="user-image">
        <i class="fa fa-user"></i>
        <span><?php echo $_SESSION["name"]; ?><span>
    </div>
    <div class="user-info">
        <div class="input-group">
            <label for="name">E-mail</label>
            <input id="name" readonly="true" value="<?php echo $_SESSION["email"]; ?>" />
        </div>
        <div class="input-group input-pass">
            <div>
                <label for="pass">Nova senha</label>
                <input id="pass" name="updatePassword" type="password" />
            </div>
            <div>
                <button onclick="updatePassword()">Alterar senha</button>
            </div>
        </div>
    </div>
</div>

<div class="popup-filter">
    <div class="popup">
        <input placeholder="Nome da jogada" type="text">
        <div class="button-group">
            <button class="popup-button save-button">Ok</button>
        </div>
    </div>
</div>

<script>
    const ajax = (config) => {
        const xhr = new XMLHttpRequest()
        
        xhr.onreadystatechange = function() {
            if(xhr.readyState == XMLHttpRequest.DONE){
                const {status, message} = JSON.parse(xhr.response)
                showAlert(status, message)
                document.querySelector("input[name=updatePassword]").value = ''
            }
        }

        xhr.open(config.method, config.url, true)
        xhr.send(config.formData)
    }

    const updatePassword = () => {
        const formData = new FormData()
        const password = document.querySelector("input[name=updatePassword]").value
        formData.append('password', password)
        ajax({
            method: "post",
            url: "./functions/changePassword.php",
            formData
        })
    }
</script>