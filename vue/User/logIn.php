
<form id="login" class="text-center border border-light p-5 my-5 bg-article" action="<?= WEBROOT ?>User/logIn" method="POST">

    <p class="h4 mb-4">Se connecter</p>
    <input type="email" id="defaultLoginFormEmail" name="email" class="form-control mb-4" placeholder="E-mail">
    <input type="password" name="password" id="defaultLoginFormPassword" class="form-control mb-4" placeholder="Password">
    <button class="btn  btn-sm btn-grad  btn-block my-4" type="submit">Se connecter</button>
    <p> Pas encore inscrit ? 
        <a href="<?= WEBROOT ?>User/signIn">S'inscrire</a>
    </p>
  	<?php 
	if (isset($log)) {
		echo $log;
	}
	 ?>

</form>


