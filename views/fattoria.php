<?php
$auth = getAuthUser();

foreach($auth->farmBuildings as $building):
    ?>
    Nome: <?=$building->nome?>
    Livello: <?=$building->livello?>
    Costo upgrade: <?=$building->costo?>
    <form method="post">
        <input type="hidden" name="building_id" value="<?=$building->building_id?>">
        <button type="submit">Costruisci</button>
    </form>

    <br>

<?php
endforeach;

