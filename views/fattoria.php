<p>I cavalli mangiano troppo? E' qui che produciamo il loro cibo!</p>
<p>Ogni livello genera più risorse</p>
<div class="edifici">

    <?php
    $auth = getAuthUser();

    foreach($auth->farmBuildings as $building):
        ?>
        <div class="card">
            <div class="titolo">
                <?=$building->nome?> (<?=$building->livello?>)
            </div>
            <img src="img/<?=strtolower($building->nome)?>.jpg">
            <p><?=$building->descrizione?></p>
            Costo upgrade: <span class="costo"><?=number_format($building->costo)?></span>
            <div class="formedifici">
                <form method="post">
                    <input type="hidden" name="building_id" value="<?=$building->building_id?>">
                    <button type="submit" name="nupgrade" value="1"<?=$auth->risorse->soldi >= $building->costo ? '': 'disabled'?>>x1</button>
                    <button type="submit" name="nupgrade" value="5" <?=$auth->risorse->soldi >= $building->costo ? '': 'disabled'?>>x5</button>
                    <button type="submit" name="nupgrade" value="50" <?=$auth->risorse->soldi >= $building->costo ? '': 'disabled'?>>x50</button>
                    <button type="submit" name="nupgrade" value="500" <?=$auth->risorse->soldi >= $building->costo ? '': 'disabled'?>>x500</button>
                </form>
            </div>
        </div>

    <?php
    endforeach;
    ?>
</div>
