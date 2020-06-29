<?php
    require('./functions/get.php');
?>

<div class="title-container">
    <h1 class="title"><div>J</div>ogos salvos</h1>
    <hr>
</div>

<?php if(isset($games) and sizeof($games) > 0){ ?>
<div class="container">
    <div class="saveds-container">
        <?php for($i = 0; $i < sizeof($games); $i++){ ?>
        <div class="saved">
            <span><?php echo $games[$i]["label"]; ?></span>
            <div>
                <button onclick="showPopup(<?php echo $i; ?>)">Visualizar</button>
                <i onclick="remove(<?php echo $games[$i]['id']; ?>)" class="fa fa-trash"></i>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
<?php } ?>

<?php for($i = 0; $i < sizeof($games); $i++){ ?>
<div class="popup-filter popup-filter-games" onl-game-popup-filter="<?php echo $i; ?>">
    <div class="popup popup-games" onl-game-popup="<?php echo $i; ?>">
        <div class="games">
            <?php for($n = 0; $n < sizeof($games[$i]["bets"]); $n++){ ?>
            <div class="game">
                <?php for($j = 1; $j <= 15; $j++){ ?>
                    <div class="circle"><?php echo $games[$i]["bets"][$n]["number".$j]; ?></div>
                <?php } ?>
            </div>
            <?php } ?>    
        </div>
        <div class="button-group">
            <button onclick="closePopup(<?php echo $i; ?>)" class="popup-button">Fechar</button>
        </div>
    </div>
</div>
<?php } ?>

<script>
    const ajax = (config) => {
        const xhr = new XMLHttpRequest()

        xhr.onreadystatechange = function() {
            if(xhr.readyState == XMLHttpRequest.DONE){
                const {status, message} = JSON.parse(xhr.response)
                showAlert(status, message)
                location.reload();
            }
        }

        xhr.open(config.method, config.url, true)
        xhr.send(config.formData)
    }

    const remove = (gameId) => {
        const formData = new FormData()
        formData.append('gameId', gameId)
        ajax({
            method: "post",
            url: "./functions/remove.php",
            formData
        })
    }

    const closePopup = (game) => {
        const popup = document.querySelector(`div[onl-game-popup='${game}']`)
        const filter = document.querySelector(`div[onl-game-popup-filter='${game}']`)
        const app = document.querySelector('#onl-app')
        popup.style.visibility = 'hidden';
        popup.style.display = 'none';
        filter.style.visibility = 'hidden';
        app.style.height = '100vh';
        app.style.overflowY = 'hidden';
    }

    const showPopup = async (game) => {
        const popup = document.querySelector(`div[onl-game-popup='${game}']`)
        const filter = document.querySelector(`div[onl-game-popup-filter='${game}']`)
        const app = document.querySelector('#onl-app')
        popup.style.visibility = 'visible';
        popup.style.display = 'flex';
        filter.style.visibility = 'visible';
        filter.style.display = 'flex';
        app.style.height = '95vh';
        app.style.overflowY = 'hidden';
    }
</script>