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
                <!-- <div class="part1">
                    <img src="../Images/login_image.jpg">
                </div> -->

                <div class="part2">
                    <h2 style="font-size: 30px;">Se connecter</h2>

                    <form action="../Controllers/c_authentification.php" method="POST" enctype="multipart/form-data">
                            <div class="inputs" style="display:flex; flex-direction:column;">
                                <input type="text" name="user_name" placeholder="Nom d'utilisateur" required>
                                <input type="text" name="password_key" placeholder="Mot de passe" required>
                            </div>

                            <div class="inputs_submit">
                                <input type="submit" class="login_btn" value="connexion">
                            </div>
                    </form>

                    <a href="v_update_password.php"  style="text-decoration:none; color:#1F57EC;">Mot de passe oublier ?</a> 
                    <!-- or -->
                    <!-- <a href="v_admin_registration.php"  style="text-decoration:none; color:rgb(13, 13, 155);">Sing in</a> -->
                </div>
            </div>

            <div class="part_forme">
            </div>
        </section>
    </body>
</html>