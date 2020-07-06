

<?php
	require 'vue/banner.php';
?>



<?php if(isset($tabArticles)){ ?>
	<div class="container text-center ">
		
		<h2 class="thin my-5">Les articles les plus récents</h2>
	
	</div>
  
	<div class="container">
        <div class="container">
          <div class="row blog">
            <div class="col-md-12">
              <div id="blogCarousel" class="carousel slide container-blog" data-ride="carousel">
              
                <!-- Carousel items -->
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <div class="row">
					<?php  foreach ($tabArticles as $key => $article) { ?>
                      <div class="col-md-4" >
                        <div class="item-box-blog bg-white col-10 border-dark">
                          <div class="item-box-blog-image" >
                            <!--Date-->
                            <div class="item-box-blog-date bg-blue-ui "> <span class="mon"><?= $article->getCost(); ?> €</span> </div>
                            <!--Image-->
                            <figure  > <img  alt="image-slider" src="<?=WEBROOT .$article->getImg(); ?>""> </figure>
                          </div>
                          <div class="item-box-blog-body">
                            <!--Heading-->
                            <div class="item-box-blog-heading">
                              <a href="#" tabindex="0">
                                <h5><?=$article->getTitle() ?>"</h5>
                              </a>
                            </div>
                            <!--Data-->
                            <div class="item-box-blog-data" style="padding: px 15px;">
                              <p><i class="fa fa-user-o"></i><?=$article->getUserPseudo()->getPseudo() ?> <i class="fa fa-comments-o"></i> <?=$article->getCategory() ?></p>
                            </div>
                            <!--Text-->
                            <div class="item-box-blog-text">
                              <p><?= substr($article->getInfo(),0,250); ?></p>
                            </div>
                            <div class="mt"> <a href="<?= WEBROOT.'Article/single/'.$article->getId()?>" tabindex="0" class="btn bg-blue-ui  read">Voir l'article</a> </div>
                            <!--Read More Button-->
                          </div>
                        </div>
                      </div>
					<?php } ?>
                     
                    </div>
                    <!--.row-->
                  </div>
                  <!--.item-->
						
                <!--.carousel-inner-->
              </div>
              <!--.Carousel-->
            </div>
          </div>
        </div>
      </div>
	  <?php } ?>

    <div class="row mt centered">
      <div class="col-lg-4 col-lg-offset-4 mx-auto">
        <button type="button" class="btn btn-theme btn-lg">Voir les articles les plus récents</button>
      </div>
    </div>
    <!-- /row -->
  </div>
  <!-- /container -->
