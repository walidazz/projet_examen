
<?php
	require 'vue/banner.php';
?>
<form class="text-center border border-light p-5 bg-article" method="POST" action="<?= WEBROOT ?>Article/update/<?= $article->getId();?>" enctype="multipart/form-data" >

<p class="h4 mb-4">Modifier un article</p>

<!-- Name -->
<input type="text" name="title" id="defaultContactFormName" class="form-control mb-4" value="<?= $article->getTitle();?>" placeholder="Titre" required>

<input type="text"  name="urlseller" value="<?= $article->getUrlseller();?>"  id="defaultContactFormName" class="form-control mb-4"  placeholder="Liens vers le vendeur">

<input type="text" name="cost" value="<?= $article->getCost();?>" id="defaultContactFormName" class="form-control mb-4" placeholder="Prix" required>
<!-- Email -->


<!-- Subject -->

<select  name="category" class="browser-default custom-select mb-4" required>
    <option value="<?= $article->getCategory();?>" ><?= $article->getCategory();?></option>
   
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
    <textarea name="info" value="<?= $article->getInfo();?>" class="form-control rounded-0" id="exampleFormControlTextarea2" rows="3" required placeholder="Ajouter une description"><?= $article->getInfo();?></textarea>
</div>

<div class="input-group">
<div class="input-group-prepend">
<span class="input-group-text"  id="inputGroupFileAddon01">Ajouter une image</span>
</div>
<div class="custom-file">
<input type="file" name="img"  class="custom-file-input" id="inputGroupFile01"
  aria-describedby="inputGroupFileAddon01">
<label class="custom-file-label" for="inputGroupFile01"></label>
</div>
</div>
<!-- Copy -->

<!-- Send button -->
<input class="btn  btn-sm btn-grad  m-4" type="submit" value="Modifier">
<?php 	
if (isset($log)) {
    echo $log;
}	
?>
</form>

