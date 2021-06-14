#include <mosquitto.h>
#include <string.h>
#include <stdio.h>
#include <stdlib.h>
#include <iostream>

using namespace std;

class mqtt 
{
    struct mosquitto * mosq;
    char topic[50] = "test";
    char message[50];
    
    int id;
    static void on_connect(struct mosquitto * mosq, void *obj, int rc);
    static void on_message(struct mosquitto * mosq, void *obj, const struct mosquitto_message *msg);
   
    public:
    mqtt(const char *id, bool cleanSession, void *userdata);
    void detruire();
    int setPasswd(const char *username, const char *password);	
    int connexion(const char *host, int port, int keepalive);
    int souscrire(int* mid, int qos);
    int publier(int *mid, int qos, bool retain, char *topic, const char *message);
    void callbackConnexion();	
    void callbackMessage();
    int loopStart();
    int loopStop(bool force);
    int reconnexion();	 
    int deconnexion();
    int getId() { return id; };
    mosquitto * getMosq() { return mosq; };
    void setMessage(char * newMessage);
    char * getMessage() {
        return message;
    }
};
