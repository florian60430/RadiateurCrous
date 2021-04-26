class mqtt 
{
    struct mosquitto * mosq;
    char message[50];
    char topic[50];

    public:
    //construc
    mqtt(const char *id, bool cleanSession, void *userdata);
    //destruct
    ~mqtt(struct mosquitto *mosq);

    //setPasswd
    int setPasswd(const char *username, const char *password);
 

    //Connect
    int connexion(const char *host, int port, int keepalive);


    //Publier
    void publier(int *mid, const char *topic, int size, const void * mqttMessage, int qos, bool retain);
 
    //Reconnect
    int reconnexion();


    //Disconnect
    void deconnexion();

    //Souscrir
    void souscrir(int *mid, char * topic, int qos);

    

}