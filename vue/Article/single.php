
<?php 
	if(isset($article)){ ?>
<div class="container col-xs-10 col-md-9 single  my-3 ">
	
<div class="container">
		<div class="card bg-article p-2">
			
			<div class="container-fliud">
				
				<div class="wrapper row">
					
					<div class="preview col-md-6">
						
						<div id="singleImg" class="preview-pic tab-content text-center" style="height:400px;width:400px;">
						  <img alt="image détaillé de l'article" style="max-height:100%;max-width:100%;" src="<?=WEBROOT.$article->getImg()?>" />
		
						</div>
					
					</div>
					<div class="details col-md-6">
						<h3 class="product-title"> <?=  $article->getTitle()?></h3>
						<div class="rating">
							
							<span class="review-no">Posté par  <a href="<?= WEBROOT. 'User/profilUser/'.$article->getUserPseudo()->getId()  ?>" class="MakaleYazariAdi label-info"><?=  $article->getUserPseudo()->getPseudo()?></a></span>
						</div>
						<p class="product-description"><?=substr($article->getInfo(), 0, 400) . "..." ?> </p>
						<h4 class="price">Prix :  <span><?=  $article->getCost()?> €</span></h4>
						 
						<h5 class="sizes">
						<span class="badge badge-info"> <?=  $article->getCategory()?></span>
				
						</h5>
						
						<div class="action">
						<a href=" http://<?=  $article->getUrlSeller()?> "><button class="add-to-cart btn btn-default btn-sm" type="button">Lien vers le vendeur</button></a>
						<a <?php echo 'href="'.WEBROOT.'Article/like/'. $article->getId().'"'; ?> > <?php if(!isset($log)){ echo 'J\'aime ('.$note.')'; } elseif(!isset($log)) {echo '<font style="green"> vote pris en compte </font>'; } else { echo '<p class="blink">'.$log . '</p>';}  ?><i class="far fa-thumbs-up"></i></a>
						</div>
					</div>
		
				</div>
				<li class=" dropdown no-deco float-right">
		<a class="dropdown-toggle" href="#"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		  Signaler 
		</a>
		<div class="dropdown-menu" style="color:white;" aria-labelledby="navbarDropdownMenuLink">
		  <a class="dropdown-item" href="<?= WEBROOT ?>/Article/ReportArticle/<?= $article->getId() ?>/Lien mort">Lien mort</a>
		  <a class="dropdown-item" href="<?= WEBROOT ?>/Article/ReportArticle/<?= $article->getId() ?>/Arnaque">Arnaque</a>
		  <a class="dropdown-item" href="<?= WEBROOT ?>/Article/ReportArticle/<?= $article->getId() ?>/Publicité personnel">Publicité</a>
		</div>
	  </li>
				<?php if(isset($_SESSION['id'])){
		if($_SESSION['statut'] == 1 OR $_SESSION['id'] == $article->getUserPseudo()->getId() ){ ?>

<a  class="float-right mx-2" href="<?= WEBROOT. 'Article/update/'.$article->getId() ?>"> <i class="fas fa-edit"></i></a>

<a class="float-right mx-2" href="<?= WEBROOT. 'Article/archive/'.$article->getId() ?>"><i class="fas fa-trash-alt"></i></a>
		<?php }
	
	if ($_SESSION['statut'] == 1){ ?>
		<a class="float-right mx-2" href="<?= WEBROOT. 'Article/delete/'.$article->getId() ?>"><i class="far fa-trash-alt"></i></a>


	<?php } }?>
			</div>
		</div>
	</div>

<div class="container my-2">
<div class="be-comment-block ">
	<h1 class="comments-title">Section commentaire</h1>
	<?php if(isset($tabComment)){ 
		
		foreach ($tabComment as $key => $comment) {  ?>
	<div class="be-comment">
		<div class="be-img-comment">	
		<a href="<?= WEBROOT?>/User/profilUser/<?= $comment->getUserId() ?>">
				<img src="<?= WEBROOT.$comment->getUserAvatar() ?>" alt="image de profil" class="be-ava-comment">
			</a>
		</div>

		<div class="be-comment-content">
			
				<span class="be-comment-name">
					<a href="<?= WEBROOT?>/User/profilUser/<?= $comment->getUserId() ?>"><?= $comment->getUserPseudo()?></a>
					</span>
					<?php if(isset($_SESSION['id'])){
	if ($_SESSION['id'] == $comment->getUserId() OR $_SESSION['statut'] == 1){  ?>
				<span class="be-comment-time">
					<?= '<a  href="'.WEBROOT.'Article/commentDelete/'.$comment->getId().'/'.$comment->getArticleId().'"><i class="fas fa-trash-alt"></i></a>'; ?>
				
				</span>
	<?php } }?>
			<p class="be-comment-text">
			<?= $comment->getMessage()?>
			</p>
		</div>
	</div>
		<?php  }  }?>

		
    
    <div class="row">
    
    <div class="col-md-6 mx-auto">
    						<div class="widget-area no-padding blank">
								<div class="status-upload">
									<form method="POST" action="<?= WEBROOT ?>Article/commentCreate">
									<input  type="hidden" name="userId" value="<?php echo $_SESSION['id']?>">
									<input type="hidden" name="articleId" value="<?php echo $article->getId()?>">
										<textarea name="message" placeholder="Ecrire un commentaire" ></textarea>
										
										<button type="submit" class="btn btn-success green"><i class="fa fa-share"></i> Poster</button>
									</form>
								</div><!-- Status Upload  -->
							</div><!-- Widget Area -->
						</div>
        
    </div>
</div>





</div>
</div>

</div>
</div>
            </div>
		
          
 

<!-- // -->
<!-- section commentaire -->
	<?php } ?>