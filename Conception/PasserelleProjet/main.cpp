/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

#include "mqtt.h"


#include <stdio.h>
#include <stdlib.h>
#include <string.h>

int main() {
     char message[50] ;

  
    
       
	printf("Tapez votre message \n");
	scanf("%s", message); 

        
                int rc;

                mosquitto_lib_init();

                mqtt mosquitto("publisher-test", true, NULL);
                rc = mosquitto.connexion("localhost", 1883, 60);
            if(rc != 0){
                printf("connexion au broker impossible ! erreur : %d\n", rc);
                mosquitto.detruire();
                return -1;
            }
            printf("Nous sommes bien connecté au broker ! \n");
          

            mosquitto.publier(NULL,  0, false);
            mosquitto.deconnexion();
            mosquitto.detruire();
            mosquitto_lib_cleanup();
            return 0;
                    
                
            
            
        
     

          
        
       

	
}