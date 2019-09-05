<?php 
$nav_title = "Gestion des commentaires"; 
?>

<?php require_once('views/header.php'); ?>

</header>

<section id="commentaires-signales" class="container">

    <br>

    <a href="connect" class="btn"><i class="fas fa-arrow-left"></i></a>

    <br><br>

    <!--Materialize Tabs-->

    <div class='col s12 m6 l4 offset-l2'>

        <ul class="tabs">
            <li class="tab col s3"><a href="#test1" class='active blue-text'><i class="fas fa-bell"></i></a></li>
            <li class="tab col s3"><a class="blue-text" href="#test2"><i class="fas fa-comment"></i></a></li>
        </ul>
    </div>

    <div class="container pt-10">

        <div class="row card">

            <div id="test1" class="col s12">
                
                <?php 
            
                if(isset($drop)): ?>

                <p>&nbsp;<?= $drop ?></p>

                <?php endif; ?>

                <h4 class='header'>&nbsp;Signalements</h4>
                
                <ul class="collection">

                    <?php foreach($alarmComments as $alarmComment): ?>

                    <li class="collection-item">

                        <p>Le commentaire de <?= ucfirst($alarmComment->pseudo()) ?> &rArr; <a href="https://login.yahoo.com/" target="_blank" class="linkmail"><?= $alarmComment->email() ?></a> posté le <?= $alarmComment->commentDate() ?> a été signalé <?= $alarmComment->alarm() ?> fois</p>

                        <p>''&nbsp;<?= $alarmComment->comment() ?>&nbsp;''</p>

                        <form action="commentaires" method="post">

                            <input type="hidden" name="act" value="<?= $alarmComment->id() ?>" />

                            <input type="submit" name="delete" class="btn right" value="Supprimer" onclick="return(confirm('Validez-vous ce choix ?'));" />

                        </form>

                        <br>
                        <br>

                    </li>

                    <?php endforeach; ?>

                </ul>

            </div>

            <div id="test2" class="col s12">

                <h4 class='header'>&nbsp;Commentaires</h4>

                <ul class="collection">

                    <?php foreach($alarmComments2 as $alarmComment2): ?>

                    <li class="collection-item">

                        <p>Posté par <?= ucfirst($alarmComment2->pseudo()) ?> &rArr; <a href="https://login.yahoo.com/" target="_blank" class="linkmail"><?= $alarmComment2->email() ?></a> le <?= $alarmComment2->commentDate() ?>&#8239;: </p>

                        <p>''&nbsp;<?= $alarmComment2->comment() ?>&nbsp;''</p>

                        <form action="commentaires" method="post">

                            <input type="hidden" name="act" value="<?= $alarmComment2->id() ?>" />

                            <input type="submit" name="delete" class="btn right" value="Supprimer" onclick="return(confirm('Validez-vous ce choix ?'));" />

                        </form>

                        <br>
                        <br>

                    </li>

                    <?php endforeach; ?>

                </ul>

            </div>
        </div>
    </div>

</section>

<?php require_once('views/footer.php'); ?>
