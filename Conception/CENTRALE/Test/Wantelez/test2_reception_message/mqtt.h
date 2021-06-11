#include <string.h>
#include <stdio.h>
#include <stdlib.h>
#include <iostream>
#include <vector>
#include <mosquitto.h>

using namespace std;

class mqtt 
{
    struct mosquitto * mosq;
    char * messageRecu;

    int id;
    static void on_connect(struct mosquitto * mosq, void *obj, int rc);
    static void on_message(struct mosquitto * mosq, void *obj, const struct mosquitto_message *msg);


    public:
    static void parseMessage(char *payload, char *idRad, char *tempRad, char *horsGel);
    mqtt(const char *id, bool cleanSession, void *userdata);
    void detruire();
    int setPasswd(const char *username, const char *password);	
    int connexion(const char *host, int port, int keepalive);
    int souscrire(int* mid, int qos, char * souscrir);
    int publier(int *mid, int qos, bool retain, char * topic, const char * message);
    void callbackConnexion();	
    void callbackMessage();
    int loopStart();
    int loopStop(bool force);
    int reconnexion();	 
    int deconnexion();
    int getId() { return id; };
    void getMessage(const struct mosquitto_message *msg);
    mosquitto * getMosq() { return mosq; };
};
