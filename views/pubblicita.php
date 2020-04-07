<?php
$auth = getAuthUser();
$tipi = [];
$tipi[] = ['costo' => 5000, 'clienti' => '+1 clienti', 'titolo' => 'Gita ai monumenti', 'img' => 'statua.jpg',
'descrizione' => 'Una semplice gita di gruppo per vedere il cavallo più imponente di tutti, il Cavallosaurus Rex'];
$tipi[] = ['costo' => 15000, 'clienti' => '+5 clienti', 'titolo' => 'Lezione di yoga', 'img' =>'yoga.jpg',
'descrizione' => 'Dopo tutto quel caffè è meglio ritrovare la calma con delle lezioni di yoga aperte a tutti, amici inclusi'];
$tipi[] = ['costo' => 50000, 'clienti' => '+20 clienti', 'titolo' => 'Torneo di Nascondino', 'img' => 'nascondino.jpg',
'descrizione' =>'Un bel torneo del gioco preferito dei cavalli.. il nascondino! Chissà che fame e sete dopo aver finito...'];
$tipi[] = ['costo' => 10000000, 'clienti' => 'RADDOPPIO CLIENTI' , 'titolo' => 'Giochi di fuoco', 'img' => 'fire.jpg',
'descrizione' =>'Ogni cavallo al mondo sogna di poter condividere sui social lo spettacolo pirotecnico di Sputafuoco Steven!'];
?>
<p>E' con gli eventi che si guadagnano nuovi clienti, più clienti ci sono, più soldi si guadagnano!</p>
<div class="eventi">
    <?php
for($i=0; $i< sizeof($tipi); $i++): ?>
    <div class="card">
        <div class="titolo">
            <?=$tipi[$i]['titolo']?>
        </div>
        <div class="descrizione">
            <img src="img/<?=$tipi[$i]['img']?>">
            <p><?=$tipi[$i]['descrizione']?></p>
        </div>
        <p>Costo: <span class="costo"><?=number_format($tipi[$i]['costo'])?></span></p>
        <form method="post">
            <input type="hidden" name="modo" value="<?=$i?>">
            <button type="submit" <?=$auth->risorse->soldi > $tipi[$i]['costo']? '' : 'disabled'?>><?=$tipi[$i]['clienti']?></button>
        </form>
    </div>

<?php endfor;
?>
</div>