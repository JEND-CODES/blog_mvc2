<?php 
$nav_title = "Connexion"; 
?>

<?php require_once('views/header.php'); ?>

</header>

<section class="container">
    <br><br><br>

    <div class="row" id="form-comment">

        <h4>Connexion</h4>

        <form action="login" method="post">

            <?php 
            
            if(!empty($errors)): ?>

            <?php foreach($errors as $error): ?>
            
            <p><?= $error ?></p>
            
            <?php endforeach; ?>

            <?php endif; ?>

            <div class="input-field col s6">
                
                <input type="text" name="user" id="user" value="<?php if(isset($user)) echo $user; ?>" placeholder="Identifiant" />
                
            </div>

            <div class="input-field col s6">
                
                <input type="password" name="password" id="password" placeholder="Mot de passe" />
                
            </div>

            <button type="submit" class="btn right">&nbsp;<i class="fas fa-sign-in-alt"></i>&nbsp;</button>

        </form>
        
    </div>
    
</section>

<br><br><br>

<?php require_once('views/footer.php'); ?>
