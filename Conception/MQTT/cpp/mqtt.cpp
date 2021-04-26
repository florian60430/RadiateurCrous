#include "mqtt.h"

class mqtt 
{
    struct mosquitto * mosq;
    char message[50];
    char topic[50];

    public:
    //construc
    struct mosquitto * mqtt(const char *id, bool cleanSession, void *userdata)
    {
        return mosq = mosquitto_new("publisher-test", true, NULL);
    }
    //destruct
    ~mqtt(struct mosquitto *mosq)
    {
        mosquitto_destroy(mosq);	 
    }

    //setPasswd
    int setPasswd(struct mosquitto *mosq, const char *username, const char *password)
    {

    }	
    //Connect
    int connexion(struct mosquitto *mosq, const char *host, int port, int keepalive)
    {
        bool rc;
        return rc = mosquitto_connect(mosq, "192.168.64.92", 1883, 60);
    }
    //Publier
    int publier(struc mosquitto *mosq, int *mid, const char *topic, int size, const void * mqttMessage, int qos, bool retain)
    {
        mosquitto_publish(*mosq, *mid, *topic, size, mqttMessage, qos, retain);
    }	
    int mosquitto_reconnect(struct mosquitto *mosq);	 
    int mosquitto_disconnect(struct mosquitto *mosq);
}