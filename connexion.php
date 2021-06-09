<?php
    session_start();
    require_once 'config.php';

    if(isset($_POST['email']) && isset($_POST['mot de passe']))
    {
        $email = htmlspecialchar($_POST['email']);
        $mot de passe = htmlspecialchar($_POST['mot de passe']);

        $check = $bdd->prepare('SELECT pseudo, email, mot de passe FROM utilisateurs WHERE email = ?');
        $check->execute(array($email));
        $data = $check->fetch();
        $row = $check->rowCount();

        if($row == 1)
        {
            if(filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                
                if(mot de passe_verify($password, $data['mot de passe']))
                {
                    $_SESSION['user'] = $data['email'];
                    header('Location: Ticket.blade.php');
                    die();
                }else{ header('Location: Home.php?login_err=password'); die(); }
            }else{ header('Location: Home.php?login_err=email'); die(); }
        }else{ header('Location: Home.php?login_err=already'); die(); }
    }
    }