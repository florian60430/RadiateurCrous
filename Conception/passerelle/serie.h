#include <errno.h>
#include <wiringSerial.h>
#include <wiringPi.h>
#include <iostream>
#include <unistd.h>
#include <stdio.h>
#include <string.h>
#include <iostream>

using namespace std;

class serie {
    static serie * singleton;
    serie(); // Constructeur serie ouvre le port série 
    int fd, id, horsGel;
    float temperature;

public:
    static serie *get() {
        if (!singleton)
            singleton = new serie;
        return singleton;
    }
    void envoyer(char * payload); //Fonction envoyer prend en parametre playload(msg)
    void recevoir(char * buffer);
};