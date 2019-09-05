<?php 
$nav_title = "Modifier le mot de passe"; 
?>

<?php require_once('views/header.php'); ?>

</header>

<section class="container">

    <br>

    <a href="connect" class="btn"><i class="fas fa-arrow-left"></i></a>

    <br><br><br>

    <div class="centered">

        <h4>Nouveau mot de passe</h4>

    </div>

    <div class="row" id="admin-size-5">

        <form action="password" method="post">
            
            <?php 
                
            if(isset($nouveau)): ?>

            <p><?= $nouveau ?></p>

            <?php endif; ?>

            <?php 
                
            if(!empty($errors)): ?>

            <?php foreach($errors as $error): ?>
            
            <p><?= $error ?></p>
            
            <?php endforeach; ?>

            <?php endif; ?>

            <div class="input-field col s6">
                
                <input type="password" name="password" id="password" value="<?php if(isset($password)) echo $password;?>" placeholder="Actuel" />
                
            </div>

            <div class="col s6">
                <br><br><br><br>
            </div>

            <div class="input-field col s6">
                
                <input type="password" name="password2" id="password2" value="<?php if(isset($password2)) echo $password2;?>" placeholder="Nouveau" />
                
            </div>

            <div class="input-field col s6">
                
                <input type="password" name="checkpwd2" id="checkpwd2" placeholder="Confirmation" />
                
            </div>

            <button type="submit" class="btn right">Modifier&nbsp;<i class="fas fa-key"></i></button>

        </form>

    </div>

</section>

<br><br>

<?php require_once('views/footer.php'); ?>
