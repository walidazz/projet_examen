
<div class="container p-5">

<ol class="breadcrumb bg-article">
 
    <li class="active">Formulaire de contact</li>
</ol>

<div class="breadcrumb bg-article">
    
    <!-- Article main content -->
    <article class="col-sm-9 maincontent">
        <header class="page-header">
            <h1 class="page-title">Contactez nous</h1>
        </header>
        
        <p>
            We’d love to hear from you. Interested in working together? Fill out the form below with some info about your project and I will get back to you as soon as I can. Please allow a couple days for me to respond.
        </p>
        <br>
            <form method="POST" action="<?= WEBROOT ?>User/contactForm">
                <div class="row">
                    <div class="col-sm-4">
                        <input class="form-control" type="text"  name="nom" placeholder="Name">
                     </div>
                    <div class="col-sm-4">
                        <input class="form-control" type="text" name="email" placeholder="Email">
                    </div>
                    <div class="col-sm-4">
                        <input class="form-control" type="text" name="phone" placeholder="Phone">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-12">
                        <textarea  name="message" placeholder="Type your message here..." class="form-control" rows="9"></textarea>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-6">
                    <?php if(isset($log)){ echo $log;} ?>

                    </div>
                 

                    <div class="col text-right">
                
                    <div class="g-recaptcha float-left mx-auto" data-sitekey="6LdZGNIUAAAAALEYKxOAzJbCigFb4nuDkByodBYa"></div>
                        <input class="btn btn-success float-right" type="submit" value="Send message">
                    </div>
                </div>
              
            </form>


    </article>
    <!-- /Article -->
    





    <!-- Sidebar -->
    <aside class="col-sm-3 sidebar sidebar-right">

        <div class="widget">
            <h4>Adresse</h4>
            <address>
        
            bla bla bla <br>
            36, Impasse. bla bla bla <br>
            30000 Nimes - France
            </address>
            <h4>Téléphone</h4>
            <address>
            Tél : +33 06 XX XX XX XX
            </address>
            <h4>Mail</h4>
            <address>
            dealbomb@gmail.com
            </address>

        </div>

    </aside>
    <!-- /Sidebar -->

</div>
</div>	<!-- /container -->