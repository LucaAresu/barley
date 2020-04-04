<?php
$auth = getAuthUser();

foreach($auth->farmBuildings as $building):
    ?>
    Nome: <?=$building->nome?>
    Livello: <?=$building->livello?>
    Costo upgrade: <?=number_format($building->costo)?>
    <form method="post">
        <input type="hidden" name="building_id" value="<?=$building->building_id?>">
        <button type="submit" name="nupgrade" value="1">x1</button>
        <button type="submit" name="nupgrade" value="5">x5</button>
        <button type="submit" name="nupgrade" value="50">x50</button>
    </form>

    <br>

<?php
endforeach;

