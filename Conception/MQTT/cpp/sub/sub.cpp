#include "mqtt.h"
#include <stdio.h>
#include <stdlib.h>
#include <string.h>

int main() {
	int rc, id = 13; 

	mosquitto_lib_init();

	mqtt mosquitto("subscribe-test", true, &id);
	//mosquitto_username_pw_set(mosq, "root", "123");
	
	mosquitto.callbackConnexion();
	mosquitto.callbackMessage();
	rc = mosquitto.connexion("192.168.1.96", 1883, 10);
	if(rc) {
		printf("Could not connect to Broker with return code %d\n", rc);
		return -1;
	}

	mosquitto.loopStart();
	printf("appuyez sur entrer pour quitter ...\n");

	getchar();
	mosquitto.loopStop(true);

	mosquitto.deconnexion();
	mosquitto.detruire();
	mosquitto_lib_cleanup();

	return 0;
}
