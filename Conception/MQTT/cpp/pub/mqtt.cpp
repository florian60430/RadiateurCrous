#include "mqtt.h"

    //construc
    mqtt::mqtt(const char *id, bool cleanSession, void *userdata)
    {
        mosq = mosquitto_new(id, cleanSession, userdata);
    }

    void mqtt::detruire()
    {
         mosquitto_destroy(mosq);	
    }

    //setPasswd
    int mqtt::setPasswd(const char *username, const char *password)
    {
        return mosquitto_username_pw_set(mosq, username, password);	 
    }	
    //Connect
    int mqtt::connexion(const char *host, int port, int keepalive)
    {

        return mosquitto_connect(mosq, host, port, keepalive);
    }
    
    //Publier
    int mqtt::publier(int *mid, int qos, bool retain)
    {
        return mosquitto_publish(mosq, mid, topic, strlen(message), message, qos, retain);
    }	
    int mqtt::reconnexion()
    {
        return 1;
    }	 
    int mqtt::deconnexion()
    {
        return mosquitto_disconnect(mosq);
    }

    /* char * getMessage()
     {
         return this.message;
     }*/
