<!-- Header -->
<header>
    <div class="header">
        <div class="row">
            <div class="side"><a href="actors.php"><img src="/img/logo.jpg" alt="logo" height="50"></a></div>
            <div class="main_header">
                <div class='bouton'>
                    <p><?php
             if (isset($_SESSION['login']) and !empty($_SESSION['login']) ){
                 echo '
            <a title="Déconnexion" href="deconnexion.php"><img alt="Se déconnecter" class="rotate" src="/img/deconnexion.png" height="30"></a>
            <a title="Profile" href="profile.php"><img alt="Profile" class="rotate" src="/img/icone_param.svg" height="40"></a>
            <img src="/img/user.png" height="40" alt="logo_user">' . $_SESSION['username'];
             }
             else {
              echo "<a href='index.php'>Connexion</a>";
             }
             ?></p>
                </div>
            </div>
        </div>
    </div>
</header>