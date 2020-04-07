<p>I cavalli hanno fame... molta fame, ed è per questo che servono macchinari più efficienti possibile.</p>
<p>Ogni livello aumenta il consumo di risorsa e il costo di vendita della singola risorsa.</p>
<div class="edifici">

<?php
$auth = getAuthUser();

foreach($auth->shopBuildings as $building):
    ?>
<div class="card">
    <div class="titolo">
        <?=$building->nome?> (<?=$building->livello?>)
    </div>
    <div class="descrizione">
        <img src="img/<?=strtolower($building->nome)?>.jpg">
        <p><?=$building->descrizione?></p>
    </div>
    <p>Costo upgrade: <span class="costo"><?=number_format($building->costo)?></span></p>
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
