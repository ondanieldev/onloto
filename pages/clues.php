<?php
    session_start();
    require('./functions/getClues.php');
?>

<div class="title-container">
    <h1 class="title"><div>D</div>icas</h1>
    <hr>
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
            <div onl-clue-type="m" onl-clue-value="<?php echo $clueMoreNumbers[$i]; ?>" class="circle circle-remove"><?php echo $clueMoreNumbers[$i]; ?></div>
            <?php } ?> 
            <input name="clue-more-number" class="clue-number-input" type="number" />
            <div onl-add-clue="more" class="circle circle-add">
                <i class="fa fa-plus"></i>
            </div>
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
            <div onl-clue-type="l" onl-clue-value="<?php echo $clueLessNumbers[$i]; ?>" class="circle circle-remove"><?php echo $clueLessNumbers[$i]; ?></div>
            <?php } ?> 
            <input name="clue-less-number" class="clue-number-input" type="number" />
            <div onl-add-clue="less" class="circle circle-add">
                <i class="fa fa-plus"></i>
            </div>
        </div>
    </div>
</div>

<script>

    const ajax = (config) => {
        const xhr = new XMLHttpRequest()

        xhr.onreadystatechange = function() {
            if(xhr.readyState == XMLHttpRequest.DONE){
                const res = JSON.parse(xhr.response)
                if(res.status==="error") showAlert(res.status, res.message)
                else if(res.status==="success") location.reload()
            }
        }

        xhr.open(config.method, config.url, true)
        xhr.send(config.formData)
    }

    document.querySelector("div[onl-add-clue=more]").onclick = () => {
        const formData = new FormData()
        const number = document.querySelector('input[name=clue-more-number]').value
        formData.append('number', number)
        formData.append('type', 'more')
        ajax({
            method: "post",
            url: "./functions/addClue.php",
            formData
        })
    }

    document.querySelector("div[onl-add-clue=less]").onclick = () => {
        const formData = new FormData()
        const number = document.querySelector('input[name=clue-less-number]').value
        formData.append('number', number)
        formData.append('type', 'less')
        ajax({
            method: "post",
            url: "./functions/addClue.php",
            formData
        })
    }

    const clues = Array.from(document.querySelectorAll(".circle-remove"))
    clues.forEach(clue => {
        clue.onclick = () => {
            const number = clue.getAttribute("onl-clue-value")
            const type = clue.getAttribute("onl-clue-type")
            const formData = new FormData()
            formData.append('number', number)
            formData.append('type', type)
            ajax({
                method: "post",
                url: "./functions/removeClue.php",
                formData
            })
        }
    })
        
    
</script>