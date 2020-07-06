
<?php
ob_start();
?>

<nav class="mb-1 my-0 navbar navbar-expand-lg navbar-dark bg-dark m-0 sticky-top">
    <a class="navbar-brand logo-text"  href="<?=WEBROOT?>Article/news/">
    <img src="<?=WEBROOT?>img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="image logo">
    Zone Fantôme
  </a>
  <a id="responsivAction"  href="<?= WEBROOT ?>Article/create"  class="mx-auto "> 
             <img height="50" width="50" src="<?= WEBROOT ?>img/add.png"  class="d-inline-block align-top float-right" alt="Bouton pour crée un article">    
        </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333"
    aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent-333">
    <ul class="navbar-nav  mx-auto">
   
      <li class="nav-item">
        <a class="nav-link" href="<?=WEBROOT?>Article/news/">Les plus récents</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?=WEBROOT?>Article/bestseller/">Les mieux notés</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">Catégorie
        </a>
        <div class="dropdown-menu dropdown-default" aria-labelledby="navbarDropdownMenuLink-333">
          <a class="dropdown-item" href="<?=WEBROOT?>Article/cat/Jeux-Videos">Jeux videos</a>
          <a class="dropdown-item" href="<?=WEBROOT?>Article/cat/Multimedia">Multimédia</a>
          <a class="dropdown-item" href="<?=WEBROOT?>Article/cat/High-Tech">High-Tech</a>
          <a class="dropdown-item" href="<?=WEBROOT?>Article/cat/Mode/">Mode</a>
          <a class="dropdown-item" href="<?=WEBROOT?>Article/cat/Coupons">Coupons</a>
          <a class="dropdown-item" href="<?=WEBROOT?>Article/cat/Voyage">Voyage</a>
          <a class="dropdown-item" href="<?=WEBROOT?>Article/cat/Gratuit">Gratuit</a>
          <?php ob_flush() ?>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?=WEBROOT?>User/contactForm">Contact</a>
      </li>
    </ul>';


    <?php if(isset($_SESSION['id'])){ ?>

 <li class="nav-item dropdown no-deco">
<a class="nav-link dropdown-toggle" href="<?=WEBROOT?>User/profilUser/'. $_SESSION['pseudo'].'" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  <?= $_SESSION['pseudo'] ?>
</a>
<div class="dropdown-menu" style="color:white;" aria-labelledby="navbarDropdownMenuLink">
  <a class="dropdown-item" href="<?=WEBROOT?>User/profilUser/<?=$_SESSION['id']?>">Mon profil</a>
  <a class="dropdown-item" href="<?=WEBROOT?>User/update/<?=$_SESSION['id']?>">Parametre</a>
  <a class="dropdown-item" href="<?=WEBROOT?>User/logOut/">Deconnexion</a> 
</div>
</li>';
<li class="nav-item no-deco">
<a class="nav-link nav-link btn btn-grad3 text-white btn-sm float-right  ml-2 mx-2" href="<?=WEBROOT?>Article/create/"> Poster un bon plan</a>
 </li>';

    <?php }
    else { ?>
    <a class="nav-link btn btn-grad2 text-white btn-sm float-right "  href="<?=WEBROOT?>User/signIn">Inscription</a>
    <a class="nav-link btn btn-grad  btn-sm  float-right ml-3"  href="<?=WEBROOT?>User/login"> Connexion</a> ';
    <?php 
  }
?>

  </div></nav>
  


   





