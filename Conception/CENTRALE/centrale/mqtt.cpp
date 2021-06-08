#include "mqtt.h"
#include "mariadb.h"

//construc
mqtt::mqtt(const char *id, bool cleanSession, void *userdata)
{
    mosq = mosquitto_new(id, cleanSession, userdata);
}

//Publier
int mqtt::publier(int *mid, int qos, bool retain, char * topic, const char * message)
{
    return mosquitto_publish(mosq, mid, topic, strlen(message), message, qos, retain);
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
//Connexion
int mqtt::connexion(const char *host, int port, int keepalive)
{

    return mosquitto_connect(mosq, host, port, keepalive);
}

//Souscrir

int mqtt::souscrire(int *mid, int qos, char * topic)
{
    return mosquitto_subscribe(mosq, mid, topic, qos);
}

//on_connect

void mqtt::on_connect(struct mosquitto *mosq, void *obj, int rc)
{

    cout << "je suis connecté" << endl;
    if (rc)
    {
        printf("Error with result code: %d\n", rc);
        exit(-1);
    }
    mosquitto_subscribe(mosq, NULL, "consigne", 2);
    mosquitto_subscribe(mosq, NULL, "temperature", 2);
}

//on message

void mqtt::on_message(struct mosquitto *mosq, void *obj, const struct mosquitto_message *msg)
{
    if (strcmp(msg->topic, "consigne") == 0)
    {
        cout << (char *)msg->payload << endl;
    }

    if (strcmp(msg->topic, "temperature") == 0)
    {
        printf("Nouveau message sur le topic \"%s\" : %s\n", msg->topic, (char *)msg->payload);
        mariadb::get()->updateTemperature((char*)msg->payload);
    }
}

void mqtt::getMessage(const struct mosquitto_message *msg)
{
    messageRecu = (char *)msg->payload;
}
//callbackConnexion

void mqtt::callbackConnexion()
{
    mosquitto_connect_callback_set(mosq, mqtt::on_connect);
}

void mqtt::callbackMessage()
{
    mosquitto_message_callback_set(mosq, mqtt::on_message);
}

int mqtt::loopStart()
{
    return mosquitto_loop_start(mosq);
}
int mqtt::loopStop(bool force)
{
    return mosquitto_loop_stop(mosq, force);
}

int mqtt::reconnexion()
{
    return 1;
}
int mqtt::deconnexion()
{
    return mosquitto_disconnect(mosq);
}

