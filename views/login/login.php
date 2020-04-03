<div class="loginbox">
    <img src="img/barley.png">
    <h3>Inserisci i tuoi dati</h3>
    <form method="post">
        <input type="hidden" name="csrf" value="<?=$_SESSION['token']?>">
        <?=error($err,'gen')?>
        <div class="form-block">
            <label for="name">Nome</label>
            <input type="text" name="name">
        </div>
        <div class="form-block">
            <label for="psw">Password</label>
            <input type="password" name="psw">
        </div>

        <div>
            <input type="hidden" name="remember" value="0">
            <input type="checkbox" name="remember" value="1">
            <label for="remember">Ricordati</label>
        </div>

        <button type="submit">Invia</button>
    </form>
    <a href="register">Registrati</a>
</div>