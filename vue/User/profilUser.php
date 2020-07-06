<?php if($_SESSION['statut'] == 1){ 
       echo '<a class="nav-link btn btn-grad2 text-white btn-sm float-right "  href="'.WEBROOT.'/User/allUsers">Administration</a>';
       } ?>

                <div class="content__inner content__inner--sm mx-auto text-color-white" style="max-width:500px">
                
                    <header class="content__title ">
                        <h1 class="text-center text-white"><?=$user->getPseudo() ?></h1>
                        <small>Membre de la communauté de ZoneFantome</small>

                        
                    </header>
                    

                    <div class="card profile bg-article">
                        <div class="profile__img">
                            <img src="<?= WEBROOT.  $user->getAvatar();?>" alt="avatar de profil de l'user">       
                        </div>
                        <div class="profile__info ">
                            <p>Vos informations personnels :</p>

                            <ul class="icon-list px-0 " style="list-style:none;">
                            <?php if($_SESSION['id'] == $user->getId() or $_SESSION['statut'] == 1 ) {?>
                                <li><i class="fas fa-user-tie"></i> Nom: <?= $user->getLastName();?> </li>
                                <li><i class="fas fa-user-ninja"></i> Prénom: <?= $user->getFirstName();?></li>
                                <li><i class="far fa-envelope"></i> Email : <?= $user->getEmail();?></li>
                                <li><i class="fas fa-ankh"></i> Date de naissance : <?= $user->getBirthday();?></li>
                            <?php } ?>
                                <li><i class="fas fa-venus-mars"></i> Genre : <?= $user->getSex();?> </li>
                                <li><i class="fas fa-gamepad"></i> Pseudo : <?= $user->getPseudo();?>  </li>
                            </ul>

                          <?php

if (isset($log)) {
	echo $log;
}
                          if($_SESSION['id'] == $user->getId()){
                            echo '<a class="btn btn-warning" href="'.WEBROOT.'User/update/'.$_SESSION['id'].'">Editer le profil</a>';
                           }
                          
                              if($_SESSION['statut'] == 1 or $_SESSION['id'] == $user->getId()){
                          
                              echo '<a  
                              onclick="userArchive('.$user->getId().')" class="btn btn-danger" href="'.WEBROOT.'User/archive/'. $user->getId().'">Désactiver le compte</a>
                              ';
                              
                              }
                            ?>


<ul class="navbar-nav mr-3 float-right p-5">
      
	  <li class=" dropdown">
		<a class="dropdown-toggle" href="#"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		  Signaler 
		</a>
		<div class="dropdown-menu" style="color:white;" aria-labelledby="navbarDropdownMenuLink">
		  <a class="dropdown-item" href="<?= WEBROOT ?>/Article/ReportUser/<?= $user->getId() ?>/Comportement abusif">Comportement abusif</a>
		  <a class="dropdown-item" href="<?= WEBROOT ?>/Article/ReportUser/<?= $user->getId() ?>/Spam">Spam</a>
          <a class="dropdown-item" href="<?= WEBROOT ?>/Article/ReportUser/<?= $user->getId() ?>/Publicité personnel">Publicité</a>
          <a class="dropdown-item" href="<?= WEBROOT ?>/Article/ReportUser/<?= $user->getId() ?>/Apologie de méthode illégal">Apologie de méthode illégal</a>
       

		</div>
	  </li>
  </ul>

                       
                        </div>
                        
                    </div>

  
                    
                </div>
          
