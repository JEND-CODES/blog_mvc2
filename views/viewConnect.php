<?php 
$nav_title = "Back Office"; 
?>

<?php require_once('views/header.php'); ?>

</header>

<div class="center-menu">

    <!-- Dropdown Trigger Materialize-->
    <a class='dropdown-trigger btn' href='#' data-target='dropdown1' id="title-menu">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Menu&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>

    <!-- Dropdown Structure -->
    <ul id='dropdown1' class='dropdown-content'>

        <li><a href="#messagerie">Messagerie<i class="fas fa-envelope"></i></a>
        </li>

        <li class="divider" tabindex="-1"></li>

        <li><a href="commentaires">Commentaires<i class="fas fa-comments"></i></a></li>

        <li class="divider"></li>

        <li><a href="edit">Nouveau chapitre<i class="fas fa-pencil-alt"></i></a></li>

        <li class="divider"></li>

        <li><a href="password">Mot de passe de <?= ucfirst($connect->user()) ?><i class="fas fa-key"></i></a></li>

        <li class="divider"></li>

        <li><a href="nosession">Se déconnecter<i class="fas fa-sign-out-alt"></i></a></li>
    </ul>


</div>


<div class="centered">

    <h4>Dernières publications</h4>

    <?php 
            
    if(isset($supprime)): ?>

    <p><?= $supprime ?></p>

    <?php endif; ?>

</div>

<?php
            
foreach($chapters as $chapter): ?>

<!-- To fix Cards reveal Size -->

<div id="admin-size-1">

    <!-- Cards reveal Materialize -->

    <div class="row">

        <div class="col s12">

            <div class="card">

                <div class="card-content">

                    <span class="card-title activator grey-text text-darken-4">

                        <p id="admin-text1" class="activator">Chapitre <?= $chapter->chapi() ?> : <?= $chapter->title() ?></p>

                        <hr size="1px" color="#dcdcdc">

                        <i class="material-icons right">more_vert</i>

                        <p id="admin-text2" class="activator">Chapitre publié le <?= $chapter->chapterDate() ?></p>

                        <?php
                        if(!empty($chapter->refreshDate())): 
                        ?>

                        <p id="admin-text3" class="activator">Dernière mise à jour le <?= $chapter->refreshDate() ?></p>

                        <?php endif; ?>

                        <hr size="2px" color="#FFFFFF">

                    </span>

                </div>

                <div class="card-reveal">

                    <span class="card-title grey-text text-darken-4">

                        <a href="chapitre&amp;id=<?= $chapter->id() ?>" class="btn  light-blue darken-3"> Lire&nbsp;<i class="fas fa-eye"></i></a>

                        <a href="change&amp;id=<?= $chapter->id() ?>" class="btn cyan darken-1"> Modifier&nbsp; <i class="fas fa-feather-alt"></i></a>

                        <div class="adjust-buttons"></div>

                        <form action="connect" method="post">

                            <input type="hidden" name="edit" value="<?= $chapter->id() ?>" />
                            <input type="submit" name="delete" class="btn cyan darken-2" value="Supprimer" onclick="return(confirm('Validez-vous ce choix ?'));" />

                        </form>

                        <i class="material-icons right">close</i>

                    </span>

                </div>
            </div>
        </div>

    </div>
</div>

<?php endforeach; ?>




<div class="centered">

    <h4>Infos</h4>

</div>

<div id="admin-size-4">

    <div class="row">

        <div class="col s12">

            <div class="card">

                <div class="card-content">
                    <br>

                    <a href="commentaires">
                        <p>Nombre de commentaires&#8239;:&#8239;<?= $alarmComments3 ?></p>
                    </a>

                    <a href="commentaires">
                        <p>Commentaires signalés&#8239;:&#8239;<?= $alarmComments ?></p>
                    </a>

                    <br>
                </div>
            </div>
        </div>
    </div>
</div>


<?php require_once('views/footer.php'); ?>
