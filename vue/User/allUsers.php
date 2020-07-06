
<?php if(isset($tabUsers)){   ?>
<div class="container-fluid p-5">
	<div class="row">
		<div class="col-md-3 ">
		     <div class="list-group ">
              <a href="#" class="list-group-item list-group-item-action active">Dashboard</a>
              <a href="<?=WEBROOT ?>User/allUsers" class="list-group-item list-group-item-action">Utilisateurs signalés</a>
              <a href="<?=WEBROOT ?>Article/allArticles" class="list-group-item list-group-item-action" >Articles signalés</a>
			  <a href="<?=WEBROOT ?>Article/allArchivedArticles" class="list-group-item list-group-item-action" >Articles archivés</a>
             
              
            </div> 
		</div>
		<div class="col-md-9">
		    <div class="card p-1">
		        <div class="card-body">
		            <div class="row">
		                <div class="col-md-2">
		                    <h4>User</h4>
		                </div>
		           
		                
		            </div>
		            <div class="row">
		                <div class="col-md-12">
		                    <table class="table table-hover ">
                                <thead class="bg-light ">
                                  <tr>
                                    <th>
                                      <div class="form-check-inline">
                                          <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" value="">
                                           </label>
                                       </div>
                                    </th>  
                                    <th>Pseudo</th>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Statut</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
								<?php } foreach ($tabUsers as $key => $user) { ?>
                                  <tr>
								  <td><a href="#"><small><img < width="30" height"30" src="<?=WEBROOT. $user->getAvatar() ?>" alt="image de profil utilisateur panel user"></small></a></td>
  
                                    <td><a href="#"><small><?= $user->getPseudo() ?> </small></a></td>
                                    <td><small><?= $user->getLastname() ?></small></td>
                                    <td><small><?= $user->getEmail() ?></small></td>
                                    <td><small><?php if($user->getStatut() == 1){ echo'Admin';} else { echo 'Membre';} ?></small></td>
                                    <td><a href="#"><small><?php if($user->getArchive() == 0){ echo'actif';} elseif($user->getArchive() == 1){ echo 'Désactivé';} else {
									echo 'en attente de confirmation';
								} ?></small></a></td>
                                    <td>
									<?php     echo ' <a class="table-link"" href="'.WEBROOT.'User/profilUser/'. $user->getId().'">'; ?>
 						
									<span class="fa-stack">
									
									<i class="fas fa-search-plus"></i>
									</span>
								</a>
								<?php     echo ' <a class="table-link"" href="'.WEBROOT.'User/archive/'. $user->getId().'">';?>									<span class="fa-stack">
										<i class="fas fa-user-lock"></i>
										
									</span>
								</a>
								<?php     echo ' <a class="table-link"" href="'.WEBROOT.'User/deban/'. $user->getId().'">';?>									<span class="fa-stack">
			
										<i class="fas fa-user-check"></i>
										
									</span>
								</a>
								<?php     echo ' <a class="table-link"" href="'.WEBROOT.'User/delete/'. $user->getId().'">';?>									<span class="fa-stack">
										
										<i class="fas fa-trash-alt"></i>
									</span>
								
									
									
                                    </td>
                                  </tr>
                  
								  <?php  } ?>
                                 
                                </tbody>
                              </table>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
	</div>
	
	<nav aria-label="Page">
  <ul class="pagination float-right">
 
  <?php 	for($i=1; $i<=$nbPage; $i++){
	  if($i == $current){ ?>
	  <li class="page-item"><a class="page-link active" href="<?= WEBROOT?>Article/allUsers/<?=$i?>"> <?=$i?>   </a></li> <?php }  else {?>

<li class="page-item"><a class="page-link" href="<?= WEBROOT?>Article/allUsers/<?=$i?>"> <u> <?=$i?></u> </a></li> <?php } } ?>

  </ul>
</nav>
</div>



































