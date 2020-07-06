
<form id="signIn" class="text-center border border-light p-5 bg-article my-5" min-width="600px" action="<?= WEBROOT ?>User/signIn" method="POST">
    <p class="h4 mb-4">Inscription</p>
    <div class="form-row mb-4">
    <input type="email" name="email" id="defaultRegisterFormEmail" class="form-control mb-4" placeholder="E-mail">
    <input type="text" name="pseudo" id="defaultRegisterFormPseudo" class="form-control mb-4" placeholder="Pseudo">
    <input type="password" id="defaultRegisterFormPassword" class="form-control" placeholder="Mot de passe" name="password" aria-describedby="defaultRegisterFormPasswordHelpBlock">
    <small id="defaultRegisterFormPasswordHelpBlock" class="form-text text-muted mb-4">
        Au moins 6 caractéres et un chiffre
    </small>
    <input type="password" id="defaultRegisterFormPassword" class="form-control" placeholder="Confirmez votre mot de passe" name="passwordConfirm" aria-describedby="defaultRegisterFormPasswordHelpBlock">
    <small id="defaultRegisterFormPasswordHelpBlock" class="form-text text-muted mb-4">
    <button class="btn  btn-sm btn-grad  my-4 btn-block" type="submit">S'inscrire</button>
    <hr>
    <p>En cliquant sur "S'inscrire" vous acceptez nos 
        
        <a href="" target="_blank">conditions d'utilisations</a> </p>

       <p> <a href="<?= WEBROOT ?>User/logIn">Vous avez déja un compte ?</a> </p>
       <?php 
if (isset($log)) {
	echo $log;
}
 ?>
</form>



