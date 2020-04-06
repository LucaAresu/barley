<div class="header">
    <div class="utente">
        <img src="img/barley.png">
        <?=$auth->name?><br>
        <a href="logout">Logout</a>

    </div>
    <div>
        <div class="header-descrizione">
            <img src="img/soldi.png" title="soldi">
        </div>

        <div id="soldi">
            <?=number_format($auth->risorse->soldi)?>
        </div>
    </div>

    <div>
        <div class="header-descrizione">
            <img src="img/caffe.png" title="caffe">
        </div>

        <div id="caffe">
            <?=number_format($auth->risorse->caffe)?>
        </div>
    </div>

    <div>
        <div class="header-descrizione">
            <img src="img/carota.png" title="carote">
        </div>
        <div id="carote">
            <?=number_format($auth->risorse->carote)?>
        </div>
    </div>
    <div>
        <div class="header-descrizione">
            <img src="img/torta.png" title="torte">
        </div>
        <div id="torte">
            <?=number_format($auth->risorse->torte)?>
        </div>
    </div>

    <div>
        <div class="header-descrizione">
            <img src="img/clienti.png" title="clienti">
        </div>
        <div id="clienti">
            <?=number_format($auth->risorse->clienti)?>
        </div>
    </div>

</div>