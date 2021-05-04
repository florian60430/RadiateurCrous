#include <stdio.h>
#include <stdlib.h>
#include <mosquitto.h>
#include <string.h>

int main(){
	
	int rc;
	char topic[50], message[50];

	printf("Sur quelle topic voulez vous enregister votre message ? \n");
	scanf("%s", topic);
	printf("Tapez votre message \n");
	scanf("%s", message);

	struct mosquitto * mosq;

	mosquitto_lib_init();

	mosq = mosquitto_new("publisher-test", true, NULL);

	rc = mosquitto_connect(mosq, "192.168.64.92", 1883, 60);
	if(rc != 0){
		printf("Client could not connect to broker! Error Code: %d\n", rc);
		mosquitto_destroy(mosq);
		return -1;
	}
	printf("We are now connected to the broker!\n");

	mosquitto_publish(mosq, NULL, topic, strlen(message), message, 0, false);
	mosquitto_disconnect(mosq);
	mosquitto_destroy(mosq);

	mosquitto_lib_cleanup();

	
	return 0;
}
