<?php
    session_start();
    if(!empty($_SESSION['connected'])) {
        header("Location:./home.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Authentification</title>
        <link rel="stylesheet" href="../Styles/authentification.css">
    </head>

    <body>

        <?php
            if(!empty($_SESSION['erreurs_aut'])) {
                $erreurs_aut = $_SESSION['erreurs_aut'];
                echo "
                    <div class='alert_erreurs'>
                        $erreurs_aut
                    </div>
                ";
            }
        ?>

        <section class="authentification_section">
            <div class="part_forme">
            </div>

            <div class="login_part">
                <div class="part1">
                    <h1 style="font-size: 30px; margin-bottom :5px;">Bonjour !</h1>
                    <p style = "margin-bottom:20px;">connectez-vous à votre compte</p>

                    <form action="../Controllers/c_authentification.php" method="POST" enctype="multipart/form-data">
                            <div class="inputs" style="display:flex; flex-direction:column;">
                                <input type="text" name="user_name" placeholder="Nom d'utilisateur" required>
                                <input type="password" name="password_key" placeholder="Mot de passe" required>
                            </div>

                            <div class="inputs_submit">
                                <input type="submit" class="login_btn" value="connexion">
                            </div>
                    </form>

                    <a href="v_update_password.php"  style="text-decoration:none; color:#1F57EC;">Mot de passe oublier ?</a> 
                    <!-- or -->
                    <!-- <a href="v_admin_registration.php"  style="text-decoration:none; color:rgb(13, 13, 155);">Sing in</a> -->
                </div>

                <div class="part2">
                    <h1 style="font-size: 30px;">Bienvenu à nouveau</h1>
                    <p>À travers <strong>Moyo Safi</strong>, nous tissons des liens d'espoir et de guérison, ainsi  chaque battement compte dans notre parcours vers la santé.</p>
                </div>
            </div>

            <div class="part_forme">
            </div>
        </section>
    </body>
</html>