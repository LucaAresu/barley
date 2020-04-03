<div class="header">
    <div>

        <?=$auth->name?><br>

    </div>
    <div>
        <div class="header-descrizione">
            <img src="img/soldi.png" title="soldi">

        </div>
        <div id="soldi">
            <?=$auth->risorse->soldi?>
        </div>
    </div>
    <div>
        <div class="header-descrizione">
            <img src="img/clienti.png" title="clienti">
        </div>
        <div id="clienti">
            <?=$auth->risorse->clienti?>
        </div>
    </div>
</div>