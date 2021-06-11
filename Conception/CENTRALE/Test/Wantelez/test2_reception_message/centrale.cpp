#include "mqtt.h"
#include <stdio.h>
#include <stdlib.h>
#include <string.h>

int main()
{
	int rc, id = 9;
	char topic[50], message[50];

	mosquitto_lib_init();

	mqtt mosquitto(NULL, true, NULL);
	
	mosquitto.callbackConnexion();
	mosquitto.callbackMessage();

	rc = mosquitto.connexion("192.168.65.250", 1883, 10);
	if (rc)
	{
		printf("Impossible de se connecter au broker %d\n", rc);
		return -1;
	}
	else
	{
		cout << "connexion au broker réussi" << endl;
	}

	mosquitto.loopStart();
	getchar();
	mosquitto.loopStop(true);

	mosquitto.deconnexion();
	mosquitto.detruire();
	mosquitto_lib_cleanup();
	return 0;
}
