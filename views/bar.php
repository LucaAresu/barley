<?php
$auth = getAuthUser();

foreach($auth->shopBuildings as $building):
    ?>
    Nome: <?=$building->nome?>
    Livello: <?=$building->livello?>
    Costo upgrade: <?=number_format($building->costo)?>
    <form method="post">
        <input type="hidden" name="building_id" value="<?=$building->building_id?>">
        <button type="submit">Costruisci</button>
    </form>

    <br>

<?php
endforeach;
