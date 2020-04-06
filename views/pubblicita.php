<?php
$auth = getAuthUser();
$tipi = [];
$tipi[] = ['costo' => 5000, 'clienti' => '+1 clienti', 'titolo' => 'Gita ai monumenti', 'img' => 'statua.jpg'];
$tipi[] = ['costo' => 15000, 'clienti' => '+5 clienti', 'titolo' => 'Lezione di yoga', 'img' =>'yoga.jpg'];
$tipi[] = ['costo' => 50000, 'clienti' => '+20 clienti', 'titolo' => 'Torneo di Nascondino', 'img' => 'nascondino.jpg'];
$tipi[] = ['costo' => 10000000, 'clienti' => 'RADDOPPIO CLIENTI' , 'titolo' => 'Giochi di fuoco', 'img' => 'fire.jpg'];
?>
<p>E' con gli eventi che si guadagnano nuovi clienti, più clienti ci sono, più soldi si guadagnano!</p>
<div class="eventi">
    <?php
for($i=0; $i< sizeof($tipi); $i++): ?>
    <div class="card">
        <div class="header">
            <?=$tipi[$i]['titolo']?>
        </div>
        <img src="img/<?=$tipi[$i]['img']?>">
        <p>Costo: <span class="costo"><?=number_format($tipi[$i]['costo'])?></span></p>
        <form method="post">
            <input type="hidden" name="modo" value="<?=$i?>">
            <button type="submit" <?=$auth->risorse->soldi > $tipi[$i]['costo']? '' : 'disabled'?>><?=$tipi[$i]['clienti']?></button>
        </form>
    </div>

<?php endfor;
?>
</div>