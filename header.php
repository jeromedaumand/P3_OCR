<!-- Header -->
<header>
    <div class="header">
        <div class="row">
            <div class="side"><a href="actors.php"><img src="/img/logo.jpg" alt="logo" height="50"></a></div>
            <div class="main_header"><?php
             if (isset($_SESSION['login']) and !empty($_SESSION['login']) ){
                 echo "<div class='bouton'><p><img src=\"/img/user.png\" height=\"30\"><a title='Déconnexion' href=\"deconnexion.php\" alt='Se déconnecter'>" . $_SESSION['username'] . "</a></p></div>";
             }
             else {
              echo "<p><a href='index.php'>Connexion</a> </p>";
             }
             ?>
            </div>
        </div>
    </div>
</header>