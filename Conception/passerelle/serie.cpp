#include "serie.h"

serie *serie::singleton = nullptr;

serie::serie() // Constructeur serie ouvre le port série grace a la librairi wiringPi
{
    if ((fd = serialOpen("/dev/serial0", 9600)) < 0)
    {
        fprintf(stderr, "Unable to open serial device: %s\n", strerror(errno)); // Sinon elle affiche un msg d'erreur
    }
}

void serie::envoyer(char *payload)
{
    serialPuts(fd, payload);
    fflush(stdout);
}

void serie::recevoir(char * buffer)
{
    int i = 0;
    while (i < 12)
    {
        buffer[i] = serialGetchar(fd);
        i++; 
    }

     printf("message recu : %s", buffer);
}

