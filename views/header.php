<!DOCTYPE html>

<html lang="fr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!--Permet de définir l'affichage du titre du site par défaut et de spécifier ensuite des titres différents dans les différentes pages-->
    <title><?php echo isset($nav_title)?$nav_title:"Billet simple pour l'Alaska"; ?></title>

    <meta name="description" content="Billet simple pour l'Alaska de Jean Forteroche">

    <meta content='width=device-width, initial-scale=1.0' name='viewport' />

    <link rel="icon" type="image/png" href="<?= URL.'content/images/feather.jpg' ?>" />

    <link rel="stylesheet" href="<?= URL.'content/style.css' ?>" />

    <link href="https://fonts.googleapis.com/css?family=Zeyada&display=swap" rel="stylesheet">

    <script src="https://cdn.tiny.cloud/1/5k258xz8b8894li1zboryqoh74ms5pwkns3ket7ysg708h1g/tinymce/5/tinymce.min.js"></script>

    <!--Chargement Langage Fr TinyMCE-->
    <script src="content/langs/fr_FR.js"></script>

    <!-- TinyMCE init function -->
    <script>
        tinymce.init({
            selector: 'textarea.tinymce',
            language: 'fr_FR',
            height: 700,
            plugins: [
                'image link code media emoticons',
            ],
            branding: false,
            force_br_newlines: true,
            force_p_newlines: false,
            forced_root_block: '',
            toolbar: 'undo redo | bold italic underline | link | image | code | media | forecolor backcolor | emoticons',
            content_css: [
                '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                '//www.tiny.cloud/css/codepen.min.css'
            ]
        });

    </script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css">

    <!-- Compiled and minified CSS -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Fontawesome and Material Icons -->

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>

<body>

    <header>
        <div class="feather-logo">
            <i class="fas fa-feather-alt"></i>
        </div>

        <div class="navbar-fixed ">
            <nav class=" blue lighten-2">
                <div class="nav-wrapper ">

                    <a href="<?= URL ?>" class="brand-logo"> 
                            <h1><strong>Billet simple pour l'Alaska</strong></h1>
                        
                    </a>

                    <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>

                    <ul class="right hide-on-med-and-down" id="bar-text">

                        <li><a href="<?= URL ?>" class="bounce-text">Accueil</a></li>

                        <li><a href="<?= URL.'index.php#chapitres' ?>" class="bounce-text">Chapitres</a></li>
                      
                        <li><a href="<?= URL.'login' ?>" class="effet-plus"> Back Office</a></li>


                    </ul>
                </div>
            </nav>
        </div>

        <ul class="sidenav" id="mobile-demo">

            <li><a href="<?= URL ?>">Accueil</a></li>

            <li><a href="<?= URL.'index.php#chapitres' ?>">Chapitres</a></li>

            <li><a href="<?= URL.'login' ?>">Back Office</a></li>


        </ul>
