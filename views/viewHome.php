<?php require_once('views/header.php'); ?>

</header>


<div id="chapitres"></div>

<br><br><br><br>

<div class="home-sub">
    <h4>Dernières publications</h4>
</div>

<div class="container">
    <div class="row">

        <?php
        foreach($chapters1 as $chapter): ?>

        <div class="col s12 l12">
            <div class="card">
                <div class="card-content">

                    <a href="chapitre&amp;id=<?= $chapter->id() ?>">
                        <h4>Chapitre <?= $chapter->chapi() ?> : <?= $chapter->title() ?></h4>
                    </a>

                    <h5><?= $chapter->content() ?>...</h5>

                    <a href="chapitre&amp;id=<?= $chapter->id() ?>" class="btn right"><i class="fas fa-eye"></i></a>

                    <br>
                    <br>

                </div>
            </div>
        </div>

        <?php endforeach; ?>

    </div>
</div>




<?php require_once('views/footer.php'); ?>
