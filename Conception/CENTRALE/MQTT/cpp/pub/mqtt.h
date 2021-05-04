#include <mosquitto.h>
#include <string.h>

class mqtt 
{
    struct mosquitto * mosq;
    char message[50] = "bonjour";
    char topic[50] = "test";

    public:
    mqtt(const char *id, bool cleanSession, void *userdata);
    void detruire();
    int setPasswd(const char *username, const char *password);	
    int connexion(const char *host, int port, int keepalive);
    int publier(int *mid, int qos, bool retain);	
    int reconnexion();	 
    int deconnexion();
    char * getMessage() { return message; };
};
