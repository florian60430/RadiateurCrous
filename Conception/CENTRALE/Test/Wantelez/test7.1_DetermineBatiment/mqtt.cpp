#include "mqtt.h"
#include "mariadb.h"

//construc
mqtt::mqtt(const char *id, bool cleanSession, void *userdata)
{
    mosq = mosquitto_new(id, cleanSession, userdata);
}

//Publier
int mqtt::publier(int *mid, int qos, bool retain, char *topic, const char *message)
{
    return mosquitto_publish(mosq, mid, topic, strlen(message), message, qos, retain);
}

void mqtt::detruire()
{
    mosquitto_destroy(mosq);
}

//Définir un mot de passe
int mqtt::setPasswd(const char *username, const char *password)
{
    return mosquitto_username_pw_set(mosq, username, password);
}
//Connexin au broker
int mqtt::connexion(const char *host, int port, int keepalive)
{

    return mosquitto_connect(mosq, host, port, keepalive);
}

//Souscription au topic
int mqtt::souscrire(int *mid, int qos, char *topic)
{
    return mosquitto_subscribe(mosq, mid, topic, qos);
}

//Callback connexion
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

//Callback message
void mqtt::on_message(struct mosquitto *mosq, void *obj, const struct mosquitto_message *msg)
{
    if (strcmp(msg->topic, "consigne") == 0)
    {
        cout << (char *)msg->payload << endl;
    }

    if (strcmp(msg->topic, "temperature") == 0)
    {
        char idRad[50], tempRad[50], horsGel[50];
    }
}

// Permet de découper l'id, la température et le hors gel de la tram reçu
void mqtt::parseMessage(char *payload, char *idRad, char *tempRad, char *horsGel)
{
    char buffer[50];
    int i = 0, j = 0;

    strcpy(buffer, payload);

    while (buffer[i] != '+')
    {
        /* id du raditauer */
        idRad[i] = buffer[i];
        i++;
    }
    i++;
    idRad[i] = '\0';
   cout << "id du radiateur : " << idRad[0] << endl;
    while (buffer[i] != '@')
    {
        /* température du radiateur */
        tempRad[j] = buffer[i];
        i++;
        j++;
    }
    i++; j++;
    tempRad[j] = '\0';
    cout << "températuer : " << tempRad << endl;

   horsGel[0] = buffer[i];
   cout << "hors gel : " << horsGel << endl;
}
void mqtt::getMessage(const struct mosquitto_message *msg)
{
    messageRecu = (char *)msg->payload;
}

//callback Connexion
void mqtt::callbackConnexion()
{
    mosquitto_connect_callback_set(mosq, mqtt::on_connect);
}

//Callback message
void mqtt::callbackMessage()
{
    mosquitto_message_callback_set(mosq, mqtt::on_message);
}

// debut de la loop
int mqtt::loopStart()
{
    return mosquitto_loop_start(mosq);
}

//fin de la loop
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
