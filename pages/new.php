<?php
    session_start();
    $availableNumbers = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25);
    require('./functions/getClues.php');
?>

<div class="title-container">
    <h1 class="title"><div>N</div>ovo jogo</h1>
    <hr>
</div>

<div class="container numbers-container">
    <h3>Escolha 5 números para serem <b>retirados</b> de suas apostas:</h3>
    <div class="numbers">
        <?php for($i = 0; $i < sizeof($availableNumbers); $i++){ ?>
        <div onl-number="<?php echo $availableNumbers[$i]; ?>" class="circle circle-click"><?php echo $availableNumbers[$i]; ?></div>
        <?php } ?>
    </div>
    <button onclick="play()">Jogar!</button>
</div>

<div class="clues-container">

    <div class="container clues-more clues">
        <div class="clues-title">
            <b>Dicas quentes!</b>
            <br/><br/>
            <span>Esses foram os números que <b>mais saíram</b> nos últimos jogos:</span>
        </div>
        <div class="numbers">
            <?php for($i = 0; $i < sizeof($clueMoreNumbers); $i++){ ?>
            <div class="circle"><?php echo $clueMoreNumbers[$i]; ?></div>
            <?php } ?> 
        </div>
    </div>

    <div class="container clues-less clues">
        <div class="clues-title">
            <b>Dicas frias!</b>
            <br/><br/>
            <span>Esses foram os números que <b>menos saíram</b> nos últimos jogos:</span>
        </div>
        <div class="numbers">
            <?php for($i = 0; $i < sizeof($clueLessNumbers); $i++){ ?>
            <div class="circle"><?php echo $clueLessNumbers[$i]; ?></div>
            <?php } ?> 
        </div>
    </div>

</div>

<div class="popup-filter popup-filter-games">
    <div class="popup popup-games">
        <div class="games">
        </div>
        <input placeholder="Nome da jogada" type="text" name="label">
        <div class="button-group">
            <button onclick="save()" class="popup-button save-button">Salvar</button>
            <button onclick="closePopup()" class="popup-button cancel-button">Cancelar</button>
        </div>
    </div>
</div>

<script>

    const availableNumbers = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25]
    let games = []

    const selectNumber = (circle) => {
        if(circle.classList.contains('circle-active'))
            circle.classList.remove('circle-active');
        else{
            const selecteds = document.querySelectorAll('.circle-active').length
            if(selecteds < 5)
                circle.classList.add('circle-active');
        }
    }

    const play = () => {
        games = []
        document.querySelectorAll('.game').forEach(el => el.remove())
        document.querySelectorAll('.circle-gen').forEach(el => el.remove())

        const checkSelected = (selectedsNumbers, number) => {
            let isNotSelected = true
            selectedsNumbers.forEach(selected => {
                if(number === parseInt(selected)) isNotSelected = false
            })
            return isNotSelected
        }

        const getRandomGame = (numbersList) => {
            const game = []
            let controlList = numbersList
            for(let i = 0; i < 15; ++i){
                const number = controlList[Math.floor(Math.random() * controlList.length)]
                game.push(number)
                controlList = controlList.filter(n => n !== number)
            }
            return game.sort((a, b)=>a-b)
        }

        const selectedsCircles = document.querySelectorAll('.circle-active')
        const selectedsNumbers = Array.from(selectedsCircles).map(circle => circle.getAttribute('onl-number'))  
        const numbersList = availableNumbers.filter(number => checkSelected(selectedsNumbers, number))
        
        const gamesDiv = document.querySelector('.games')
        for(let i = 0; i < 10; ++i){
            games.push(getRandomGame(numbersList))
            const gameDiv = document.createElement('div')
            gameDiv.classList.add('game')
            for(let j = 0; j < games[i].length; ++j){
                let circle = document.createElement('div')
                circle.classList.add('circle')
                circle.classList.add('circle-gen')
                circle.innerHTML = games[i][j]
                gameDiv.appendChild(circle)
            }
            gamesDiv.appendChild(gameDiv)
        }

        showPopup()
    }

    const save = () => {
        const formData = new FormData()
        let label = document.querySelector('input[name=label]').value
        label = label === '' ? 'Sem título' : label
        formData.append('label', label)
        formData.append('games', games)
        ajax({
            method: "post",
            url: "./functions/save.php",
            formData
        })
    }

    const ajax = (config) => {
        const xhr = new XMLHttpRequest()

        xhr.onreadystatechange = function() {
            if(xhr.readyState == XMLHttpRequest.DONE){
                const {status, message} = JSON.parse(xhr.response)
                showAlert(status, message)
                const selecteds = document.querySelectorAll('.circle-active')
                selecteds.forEach(circle => circle.classList.remove('circle-active'))
                closePopup()
            }
        }

        xhr.open(config.method, config.url, true)
        xhr.send(config.formData)
    }

    const showPopup = async () => {
        const selecteds = document.querySelectorAll('.circle-active').length
        if(selecteds !== 5) return
        const popup = document.querySelector('.popup')
        const filter = document.querySelector('.popup-filter')
        const app = document.querySelector('#onl-app')
        const main = document.querySelector('#onl-main')
        popup.style.visibility = 'visible';
        popup.style.display = 'flex';
        filter.style.visibility = 'visible';
        filter.style.display = 'flex';
        app.style.height = '95vh';
        app.style.overflowY = 'hidden';
    }

    const closePopup = () => {
        const popup = document.querySelector('.popup')
        const filter = document.querySelector('.popup-filter')
        const app = document.querySelector('#onl-app')
        popup.style.visibility = 'hidden';
        popup.style.display = 'none';
        filter.style.visibility = 'hidden';
        filter.style.display = 'none';
        app.style.height = '100vh';
        app.style.overflowY = 'scroll';
    }    

    function abbleSelectCircle(){ 
        document
        .querySelectorAll('.circle-click')
        .forEach(circle => circle.onclick = e => selectNumber(e.target))
    }

    abbleSelectCircle()

</script>