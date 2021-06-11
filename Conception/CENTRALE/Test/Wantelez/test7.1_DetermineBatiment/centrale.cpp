#include "mqtt.h"
#include "mariadb.h"
#include <stdio.h>
#include <stdlib.h>
#include <string.h>

int main()
{
	int rc, id = 9;

	mosquitto_lib_init();

	mqtt mosquitto(NULL, true, NULL);

	mosquitto.callbackConnexion();
	mosquitto.callbackMessage();
	rc = mosquitto.connexion("localhost", 1883, 10);
	if (rc)
	{
		printf("Impossible de se connecter au broker %d\n", rc);
		return -1;
	}

	mosquitto.loopStart();
	mariadb::get()->determinePeriode(mosquitto.getMosq());
	mosquitto.loopStop(true);

	mosquitto.deconnexion();
	mosquitto.detruire();
	mosquitto_lib_cleanup();

	return 0;
}
