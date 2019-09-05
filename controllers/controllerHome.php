<?php

$repositoryChapter = new RepositoryChapter($bdd);

$chapters1 = $repositoryChapter->selectChapters1();

require_once('views/viewHome.php');


