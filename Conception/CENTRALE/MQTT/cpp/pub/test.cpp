#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include "mqtt.h"
#include <iostream>

using namespace std;

int main(){

    int verif;
    
    mqtt mosquitto("publisher-test", true, NULL);

    verif = mosquitto.connexion("localhost", 1883, 60);
   
    if (verif != 0)
    {
        cout << "impossible de se connecter au broker" << endl;
    }
    else 
    {
        cout << "connexion au broker réussi" << endl;
    }



    verif = mosquitto.publier(NULL,  0, false);

    if (verif != 0)
    {
        cout << "impossible d'envoyer le message" << endl;
    }
    else 
    {
        cout << "le message \"" << mosquitto.getMessage() << "\" à bien été envoyé " << endl;
    }

/*      verif = mosquitto.setPasswd("florian", "mdp123");
    if (verif != 0)
    {
        cout << "impossible de configurer l'utilisateur" << endl;
    }
    else 
    {
        cout << "utilisateur configuré" << endl;
    }*/


    verif = mosquitto.deconnexion();
    if (verif != 0)
    {
        cout << "impossible de se deconnecter" << endl;
    }
    else 
    {
        cout << "deconnexion réussi" << endl;
    }



return 0;
}