<?php

function verification($bdd, $login, $password)
{
        $result = $bdd->query("SELECT * from admin WHERE user ='" . $login . "' AND mdp = '" . $password . "'");
        if (!$result->rowcount()) {
            return false;
        } else {
            return true;
        }
}
