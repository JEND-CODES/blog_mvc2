<?php 
$nav_title = $chapter->title(); 
//permet de définir le titre du chapitre comme titre de l'onglet du navigateur
?>

<?php require_once('views/header.php'); ?>

</header>

<div class="parallax-container">
    <div class="parallax">

        <img src="<?php echo $dir."/".$random_img ?>" alt="illustration" title="illustration">

        <div id="chapter-title">
            <p id="chapter-title2">Chapitre <?= $chapter->chapi() ?> : <?= $chapter->title() ?></p>
        </div>

    </div>
</div>

<div class="section white">
    <div class="row container">

        <p><?= $chapter->content() ?></p>
        
        <br>
        
        <p class="signature">Chapitre publié le <?= $chapter->chapterDate() ?></p>

        <br>

    </div>
</div>

<div class="parallax-container">
    <div class="parallax">

        <img src="<?php echo $dir2."/".$random_img2 ?>" alt="illustration" title="illustration">

    </div>
</div>

<br>

<div class="row" id="chapter-link">

    <?php 
    if($prevChapter): ?>

    <a href="chapitre&amp;id=<?= $prevChapter->id() ?>" class="btn"><i class="fas fa-chevron-left"></i></a>

    <?php endif; ?>

    <a href="<?= URL.'sommaire' ?>" class="btn"><i class="fas fa-book-open"></i></a>

    <?php
    if($nextChapter): ?>

    <a href="chapitre&amp;id=<?= $nextChapter->id() ?>" class="btn"><i class="fas fa-chevron-right"></i></a>

    <?php endif; ?>

    <br>
    <br>

    <!-- Appréciation du chapitre-->
    <p id="chap-like">Avez-vous apprécié ce chapitre ?</p>

    <?php 
                
    if(isset($likethis)): ?>

    <br>
    <p><?= $likethis ?></p>

    <?php endif; ?>

    <form action="#chap-like" method="post">

        <input type="hidden" name="alarm" value="<?= $chapter->id() ?>" />

        <input type="submit" name="loving" class="btn blue lighten-2" value="Oui !" onclick="return(confirm('Validez-vous ce choix ?'));" />

    </form>

</div>

<br>
<br>

<div class="row" id="form-comment">

    <form id="form" action="#victory" method="post">

        

        <div class="centered">
            <h4 class="flower">Commenter ce chapitre</h4>
        </div>

        <div class="input-field col s6">
            <input type="text" name="pseudo" id="pseudo" value="<?php if(isset($pseudo)) echo $pseudo; ?>" placeholder="Votre nom" />
        </div>

        <div class="input-field col s6">
            <input type="email" name="email" id="email" value="<?php if(isset($email)) echo $email; ?>" placeholder="Votre adresse mail" />
        </div>

        <br />
        <textarea name="comment" id="comment"><?php if(isset($comment)) echo $comment; ?></textarea>

        <br />
        <input type="submit" name="add" class="btn right" value="Envoyer" onclick="return(confirm('Validez-vous ce choix ?'));"/>
    </form>
    <br />

</div>


<br id="signal">

<section class="chapter-part2" id="victory">

    <div class="container" id="ghost0">

        <?= 
    //Affiche le bouton toggle commentaires    
    $toggle 
    ?>

    </div>

    <div class="container" id="ghost1">
        
        <?php 
                
        if(!empty($errors)): ?>
        
        <br>

        <?php foreach($errors as $error): ?>

        <div class="centered">
        <p><?= $error ?></p>
        </div>

        <?php endforeach; ?>
        
        <br>

        <?php endif; ?>


        <?php 
                
    if(isset($realized)): ?>

        <p><?= $realized ?></p>

        <?php endif; ?>


        <?php
    
    if(isset($ok)): ?>

        <p><?= $ok ?></p>

        <?php endif; ?>


        <?= 
        // Message lorsqu'il n'y a pas encore de commentaires
        $nocomment2 
        ?>


        <?php
        // Affichage des 5 derniers commentaires
        foreach($comments2 as $comAsc): ?>

        <hr size="1px" color="#dcdcdc">

        <p>Par <?= ucfirst($comAsc->pseudo()) ?> le <?= $comAsc->commentDate() ?></p>
        <p>'' <?= $comAsc->comment() ?> ''</p>

        <form action="#signal" method="post">

            <input type="hidden" name="act" value="<?= $comAsc->id() ?>" />
            <input type="submit" name="alert" class="btn" value="Signaler" onclick="return(confirm('Validez-vous ce choix ?'));" />

        </form>

        <br>

        <?php endforeach; ?>

    </div>


    <div class="container" id="ghost2">

        <h4><?= $nocomment ?> (total&#8239;:&#8239;<?= $countComments ?>)</h4>
        <br>

        <?php
        // Affichage de tous les commentaires du chapitre
        foreach($comments as $comDesc): ?>

        <hr size="1px" color="#dcdcdc">

        <p>Par <?= ucfirst($comDesc->pseudo()) ?> le <?= $comDesc->commentDate() ?></p>
        <p>'' <?= $comDesc->comment() ?> ''</p>

        <form action="#signal" method="post">

            <input type="hidden" name="act" value="<?= $comDesc->id() ?>" />

            <input type="submit" name="alert" class="btn" value="Signaler" onclick="return(confirm('Validez-vous ce choix ?'));" />

        </form>

        <br>

        <?php endforeach; ?>

    </div>

</section>



<?php require_once('views/footer.php'); ?>
