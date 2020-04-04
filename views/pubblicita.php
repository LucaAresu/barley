<?php

$tipi = [];
$tipi[] = ['costo' => 5000, 'clienti' => '+1'];
$tipi[] = ['costo' => 15000, 'clienti' => '+5'];
$tipi[] = ['costo' => 50000, 'clienti' => '+20'];
$tipi[] = ['costo' => 10000000, 'clienti' => 'raddoppio'];

for($i=0; $i< sizeof($tipi); $i++):?>

<div>
    <p>Guadagno clienti: <?=$tipi[$i]['clienti']?> Costo: <?=number_format($tipi[$i]['costo'])?> </p>
    <form method="post">
        <input type="hidden" name="modo" value="<?=$i?>">
        <button type="submit">Compra</button>
    </form>
</div>
<?php endfor;