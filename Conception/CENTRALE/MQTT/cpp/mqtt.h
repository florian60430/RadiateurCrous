class mqtt 
{
    struct mosquitto * mosq;
    char message[50];
    char topic[50];

    public:
    struct mosquitto * mqtt(const char *id, bool cleanSession, void *userdata);
    ~mqtt(struct mosquitto *mosq);
    int mosquitto_username_passwd_set(struct mosquitto *mosq, const char *username, const char *password);	
    int mosquitto_connect(struct mosquitto *mosq, const char *host, int port, int keepalive);
    int mosquitto_publish(struc mosquitto *mosq, int *mid, const char *topic, int payloadlen, const void * payload, int qos, bool retain);	
    int mosquitto_reconnect(struct mosquitto *mosq);	 
    int mosquitto_disconnect(struct mosquitto *mosq);

};