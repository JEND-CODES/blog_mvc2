<?php 
$nav_title = "Modifier un chapitre"; 
?>

<?php require_once('views/header.php'); ?>

</header>

<br>
<section class="container">

    <a href="connect" class="btn"><i class="fas fa-arrow-left"></i></a>

    <br><br>

    <div class="row">

        <form action="change&amp;id=<?= $chapter->id() ?>" method="post">

            <?php 
                
            if(isset($checked)): ?>

            <p><?= $checked ?></p>

            <?php endif; ?>

            <?php 
                
            if(!empty($errors)): ?>

            <?php foreach($errors as $error): ?>

            <p><?= $error ?></p>

            <?php endforeach; ?>

            <?php endif; ?>

            <div class="input-field col s12">

                <input type="text" name="title" id="title" value="<?= $chapter->title() ?>" placeholder="Titre du chapitre" />

            </div>

            <div class="input-field col s6">

                <input type="number" name="chapi" id="chapi" value="<?= $chapter->chapi() ?>" placeholder="Numéro" />

            </div>

            <div class="input-field col s6">

                <input type="text" name="zerolink" id="zerolink" value="<?= $chapter->zerolink() ?>" placeholder="Thumbnail" />

            </div>

            <br>

            <div class="adjust-tiny">
                <br><br><br><br><br><br><br><br>
            </div>

            <textarea name="content" id="content" class="tinymce"><?= $chapter->content() ?></textarea>

            <br>

            <button type="submit" class="btn right">Modifier&nbsp;<i class="fas fa-exchange-alt"></i></button>

        </form>

    </div>

</section>

<?php require_once('views/footer.php'); ?>
