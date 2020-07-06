
<?php
	require 'vue/banner.php';
?>
<form class="text-center border border-light p-5 bg-article" action="<?= WEBROOT ?>/Article/create" method="POST" enctype="multipart/form-data" >

    <p class="h4 mb-4">Créer un article</p>

    <!-- Name -->
    <input type="text" name="title" id="defaultContactFormName" class="form-control mb-4" placeholder="Titre" required>

	<input type="text"  name="urlseller" id="defaultContactFormName" class="form-control mb-4" placeholder="Liens vers le vendeur">
	<input type="text" name="cost" id="defaultContactFormName" class="form-control mb-4" placeholder="Prix" required>
    <!-- Email -->
    

    <!-- Subject -->
   
    <select  name="category" class="browser-default custom-select mb-4" required>
        <option value="" disabled>Catégorie</option>
       
        <option value="Multimedia">Multimédia</option>
        <option value="High-Tech">High Tech</option>
        <option value="Jeux-Videos">Jeux Vidéos</option>
        <option value="Mode">Mode</option>
        <option value="Coupons">Coupons</option>
        <option value="Voyage">Voyage</option>
        <option value="Gratuit">Gratuit</option>
    </select>

    <!-- Message -->
    <div class="form-group">
        <textarea name="info" class="form-control rounded-0" id="exampleFormControlTextarea2" rows="3" required placeholder="Ajouter une description"></textarea>
    </div>

	<div class="input-group">
  <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroupFileAddon01">Ajouter une image</span>
  </div>
  <div class="custom-file">
    <input type="file" name="img" class="custom-file-input" id="inputGroupFile01"
      aria-describedby="inputGroupFileAddon01">
    <label class="custom-file-label" for="inputGroupFile01"></label>
  </div>
</div>
    <!-- Copy -->


    <!-- Send button -->
    <button class="btn btn-info  m-4" type="submit">Poster cet article</button>
	<?php 	
	if (isset($log)) {
		echo $log;
	}	
	?>
</form>
