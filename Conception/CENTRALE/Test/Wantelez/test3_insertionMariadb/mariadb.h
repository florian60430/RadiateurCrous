#include <mysql.h>
#include <string.h>
#include <stdio.h>
#include <stdlib.h>
#include <iostream>
#include <ctime>
#include <unistd.h>
#include <mosquitto.h>

using namespace std;

class mariadb {
   static mariadb *singleton;
   mariadb(); 
public:
   static mariadb *get()    {
      if (!singleton)
         singleton = new mariadb;
      return singleton;
   }
   ~mariadb();
void updateEtat(char *idRad, char *horsgel);
void updateTemperature(char * idRad, char * tempRad);

void determinePeriode(struct mosquitto * mosq);
void constructBufferTemp(char * buffer, float consigneDegre);
int calculJourNuit();

private:
MYSQL *conn;
char tmp;
char request[500];
int idRad;

time_t actuel = time(0);
tm *ltm = localtime(&actuel);
int jourActuel = ltm->tm_wday;
int heureActuel = ltm->tm_hour;
int minuteActuel = ltm->tm_min;
char tempActuel[50];

MYSQL_RES * selectIdChauffage(MYSQL_RES *resIdRadiateur);
MYSQL_ROW compteNbConsigne();
MYSQL_ROW compteNbConsigneProg();
MYSQL_ROW selectIdBat();
MYSQL_ROW selectDegreConsigneJour();
MYSQL_ROW selectDegreConsigneNuit();
MYSQL_ROW selectConsigne();
void updateHeure();

};