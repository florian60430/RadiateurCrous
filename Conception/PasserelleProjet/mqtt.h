/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/* 
 * File:   mqtt.h
 * Author: Florian
 *
 * Created on 30 avril 2021, 08:14
 */

#ifndef MQTT_H
#define MQTT_H

#include <mosquitto.h>
#include <string.h>
#include <stdio.h>
#include <stdlib.h>

class mqtt 
{ public:
    //PUB
    struct mosquitto * mosq;
  
    char *msg[50];

   
    mqtt(const char *id, bool cleanSession, void *userdata);
    void detruire();
    int setPasswd(const char *username, const char *password);	
    int connexion(const char *host, int port, int keepalive);
    int publier(int *mid, int qos, bool retain);	
    int reconnexion();	 
    int deconnexion();

    
};

#endif /* MQTT_H */

