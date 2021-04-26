#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include "mqtt.h"
#include <iostream>

using namespace std;

int main(){

    int verif;
    
    mqtt mosquitto("publisher-test", true, NULL);

    mosquitto.callbackConnexion();
	mosquitto.callbackMessage();


    verif = mosquitto.connexion("192.168.1.96", 1883, 60);
   
    if (verif != 0)
    {
        cout << "impossible de se connecter au broker" << endl;
    }
    else 
    {
        cout << "connexion au broker réussi" << endl;
    }

	mosquitto.loopStart();
	printf("appuyez sur entrer pour quitter ...\n");

	getchar();
	mosquitto.loopStop(true);


 /* verif = mosquitto.setPasswd("florian", "mdp123");
    if (verif != 0)
    {
        cout << "impossible de configurer l'utilisateur" << endl;
    }
    else 
    {
        cout << "utilisateur configuré" << endl;
    }
*/
    verif = mosquitto.deconnexion();
    if (verif != 0)
    {
        cout << "impossible de se deconnecter" << endl;
    }
    else 
    {
        cout << "deconnexion réussi" << endl;
    }

    mosquitto.detruire();

return 0;
}