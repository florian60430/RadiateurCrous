#include "mqtt.h"

class mqtt 
{
    struct mosquitto * mosq;
    char message[50];
    char topic[50];

    public:
    //construc
        mqtt(const char *id, bool cleanSession, void *userdata)
    {
        mosq = mosquitto_new("publisher-test", true, NULL);
    }
    //destruct
    ~mqtt(struct mosquitto *mosq)
    {
        mosquitto_destroy(mosq);	 
    }

    //setPasswd
    int setPasswd(const char *username, const char *password)
    {
        int mosquitto_username_pw_set(*mosq, *username, *password);	 
    }	

    //Connect
    int connexion(const char *host, int port, int keepalive)
    {
        bool rc;
        return rc = mosquitto_connect(*mosq, *host, port, keepalive /*default 60s*/);
    }

    //Publier
    void publier(int *mid, const char *topic, int size, const void * mqttMessage, int qos, bool retain)
    {
        mosquitto_publish(*mosq, *mid, *topic, size, mqttMessage, qos, retain);
    }
    
    //Reconnect
    int reconnexion()
    {
        int rc;
        rc = mosquitto_reconnect(*mosq);	 
    }

    //Disconnect
    void deconnexion()
    {
        mosquitto_disconnect(*mosq);
    }

    //Sourcrir
    void souscrir(int *mid, char * topic, int qos) 
    {
       mosquitto_subscribe(*mosq, *mid, *topic, 0);
    }
    

}