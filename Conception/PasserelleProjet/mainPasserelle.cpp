/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/* 
 * File:   mainPasserelle.cpp
 * Author: Florian
 *
 * Created on 30 avril 2021, 10:31
 */

#include "passerelle.h"
#include <mosquitto.h>
#include <stdio.h>
#include <stdlib.h>
#include <string.h>

int main() {
     char message[50] ;
     char topic[50];
	int rc,i, id = 13; 

	mosquitto_lib_init();

	passerelle mosquitto("subscribe-test", true, &id);
	//mosquitto_username_pw_set(mosq, "root", "123");
	
           
	mosquitto.callbackConnexion();
	mosquitto.callbackMessage();
	rc = mosquitto.connexion("localhost", 1883, 10);
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
