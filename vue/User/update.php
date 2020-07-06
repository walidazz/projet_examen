

<div class=" p-2 mx-auto m-1 my-5 bg-article " style="max-width:600px">
    <div class="row">
  		<div class="col-sm-12 center-block text-center"><h1 ">Modifier son profil</h1></div>
    	<!-- <div class="col-sm-2"><a href="/users" class="pull-right"></div> -->
    </div>
    <div class="row ">
  		<div"><!--left col-->
              

 
          
        </div><!--/col-3-->
    	<div class="col-sm-12 bg-article ">
  

              
          <div class="tab-content bg-article">
            <div class="tab-pane active" id="home">
                <hr>
                  <form class="form" method="post" id="registrationForm" action="<?= WEBROOT ?>User/update/<?= $user->getId();?>" enctype="multipart/form-data" >
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="firstname"><h4>Prénom</h4></label>
                              <input type="text" class="form-control" name="firstname" value="<?php echo $user->getFirstName();?>" id="first_name" placeholder="Entrez votre prénom" title="Entrez votre prénom">
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                            <label for="lastname"><h4>Nom</h4></label>
                              <input type="text"  class="form-control" name="lastname" value="<?php echo $user->getLastName();?>" id="last_name" placeholder="Entrez votre nom" title="Entrez votre nom">
                          </div>
                      </div>
          
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="pseudo"><h4>Pseudo</h4></label>
                              <input type="text" class="form-control" name="pseudo" value="<?php echo $user->getPseudo();?>"  placeholder="Entrez votre pseudo" title="Entrez votre pseudo">
                          </div>
                      </div>
          
                      <div class="form-group">
                          <div class="col-xs-6">
                             <label for="email"><h4>Email</h4></label>
                              <input type="text" class="form-control" name="email" value="<?php echo $user->getEmail();?>" placeholder="Entrez votre adresse mail" title="Entrez votre adresse mail" >
                          </div>
                      </div>
                      <div class="form-group">
                          
                      <div class="form-group row">
                     
  <div class="col-10">
  <label for="birthday"><h4>Date de naissance</h4></label>
    <input class="form-control" type="date" name="birthday"  value="<?php echo $user->getBirthday();?>" min="1960-12-31" required>
  </div>
</div>

<select  name="sex" class="browser-default custom-select mb-4" required>
        <option value="<?php echo $user->getSex();?>"> Sexe </option>
        <option value="Male">Homme</option>
		<option value="Female">Femme</option>
    </select>

    <!-- <label for="avatar">Changer son avatar</label> -->
    <label for="avatar"><h4>Ajouter un avatar de profil</h4></label>

 <input title="Ajouter un avatar de profil" type="file" name="avatar" placeholder="Changer votre avatar" value="<?php echo $user->getAvatar();?>" > 

<!-- 
<input id ="submit" type="submit" value="Mettre à jour le profil" /> -->


   
      
   
                      <div class="form-group">
                           <div class="col-xs-12">
                                <br>
                                <input class="btn btn-lg btn-success" type="submit" value="Mettre à jour le profil" />
                              	<!-- <button class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Save</button> -->
                               
                            </div>
                      </div>
              	</form>
              
              <hr>
              
               
              </div><!--/tab-pane-->
          </div><!--/tab-content-->

        </div><!--/col-9-->
    </div><!--/row-->

