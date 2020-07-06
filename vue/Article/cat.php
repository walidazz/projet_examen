
<?php
	require 'vue/banner.php';
if(isset($log)) {
    echo $log;
    
} 

if(isset($tabArticles)){
?>


<!-- // : -->


  
<div class="container-fluid text-center">  

  <div class="row content">
    <div class="col-sm-2 sidenav">
 
    </div>


    <div class="col-sm-8 text-left"> 
    <div class="panel panel-default widget  ">
    
    <div class="panel-body">
        <ul class="list-group">


        <ol class="breadcrumb bg-article">

<li class="active">Affichage par catégorie</li>
</ol>

<?php  foreach ($tabArticles as $key => $article) {  ?>
            <li class=" bg-article list-group-item  mb-2 bg-article text-dark view zoom " style="color:white;" >
                <div class="row ">
                
                    <div class="col-xs-2 col-md-2 p-1  ">
                        <img style="height:150px;width:150px;" src="<?= WEBROOT. $article->getImg() ?>" class=" img-circle  img-responsive imgArticle border border-white" alt="image article" /></div>
                    <div class="col-xs-10 col-md-9">
                        <div>
                        
                            <a id="title" href="<?= WEBROOT?>/Article/single/<?=$article->getId() ?>" >
                            <?=substr($article->getTitle(), 0, 100)?></a>
                            <div class="mic-info title">
                                posté par : <a href="<?= WEBROOT?>/User/profilUser/<?=$article->getUserPseudo()->getId() ?>"><?= $article->getUserPseudo()->getPseudo() ?></a>
                                
                            </div>
              
                        </div>
                        <div class="comment-text">
                        <p "><?=substr($article->getInfo(), 0, 300) . "..." ?>  </p>                             </div>
                        <?php if(isset($_SESSION['id'])){
    if($_SESSION['statut'] == 1 ){ ?>
                        <a href="<?= WEBROOT?>/Article/update/<?=$article->getId() ?>"> <i class="label-info  fas fa-edit"></i></a> 
                        <a href="<?= WEBROOT?>/Article/delete/<?=$article->getId() ?>"> <i class=" label-info mr-2 fas fa-trash-alt"> </i></a>
                        <a href="<?= WEBROOT?>Article/archive/<?=$article->getId() ?>"> <i class=" label-info mr-2 fas fa-ban"> </i></a>

    <?php }} ?>


    <span class="badge badge-info"> <?=  $article->getCategory()?></span>
			   <span class="badge badge-danger">  <?=  $article->getCost()?> € </span>
			   <?php if($article->getUrlSeller() != NULL){ echo '<a class="badge badge-warning" href=" http://' . $article->getUrlSeller(). '">  Liens vers le vendeur</a>';} ?>

                        <div class="float-right">
                       <a href="<?= WEBROOT?>/Article/single/<?=$article->getId() ?>"> <button type="button" class="btn  btn-sm btn-grad ">Voir l'article</button>   </a>          
                       </div> 
                    </div>
                     
                </div>
            </li>
<?php } ?>
<nav aria-label="Page">
  <ul class="pagination float-right">
 
  <?php 	for($i=1; $i<=$nbPage; $i++){
	  if($i == $current){ ?>
	  <li class="page-item"><a class="page-link active" href="<?= WEBROOT?>Article/cat/<?=$article->getCategory().'/'.$i?>"> <?=$i?>   </a></li> <?php }  else {?>

<li class="page-item"><a class="page-link" href="<?= WEBROOT?>Article/cat/<?=$article->getCategory().'/'.$i?>"> <u> <?=$i?></u> </a></li> <?php } } ?>

  </ul>
</nav>
        </ul>
       
    </div>
</div> 




    </div>



    <div class="col-sm-2 sidenav zoom">


    <a id="btnCreate" href="<?= WEBROOT ?>Article/create"  class="mx-auto "> 
    <div class="sonar-wrapper">
	<div class="sonar-emitter">
    <div class="sonar-wave"></div>
  </div>
</div> 
        
        </a>
    </div>

  </div>

 

</div>

    <?php } ?>
















<!-- // -->
















