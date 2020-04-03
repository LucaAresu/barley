<div class="loginbox">
<?=error($err,'gen')?>
    <form method="post">
        <input type="hidden" name="csrf" value="<?=$_SESSION['token']?>">

        <div class="form-block">
            <?=error($err, 'name')?>
            <label for="name">Nome</label>
            <input type="text" name="name">
        </div>

        <div class="form-block">
            <?=error($err,'psw')?>
            <label for="psw1">Inserisci la password</label>
            <input type="password" name="psw1">
        </div>

        <div class="form-block">
            <label for="psw2">Ripeti la password</label>
            <input type="password" name="psw2">
        </div>



        <button type="submit">Invia</button>
    </form>
</div>