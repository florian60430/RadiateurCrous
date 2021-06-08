<?php

function verification($bdd, $login, $password)
{
        $result = $bdd->query("SELECT * from admin WHERE user ='" . $login . "' AND mdp = '" . $password . "'");
        if (!$result->rowcount()) {
            return false;
        } else {
            $result = $bdd->query("SELECT * FROM `admin` WHERE user ='" . $login . "' AND mdp = '" . $password . "' AND droit ='admin'");
            if ($result->rowcount())
            {
                return 2;
            }
            else 
            {
                return 1;
            }
        }
}

function veradmin($bdd)
{
        $result = $bdd->query("SELECT * FROM `admin` WHERE droit ='admin'");
        if (!$result->rowcount()) {
            return false;
        } else {
            return true;
        }
}