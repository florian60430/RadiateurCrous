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
void updateTemperature(char * payload);
void determineChauffe();
void determinePeriode(struct mosquitto * mosq);
void selectALL();

private:
MYSQL *conn;

time_t actuel = time(0);
tm *ltm = localtime(&actuel);
int jourAcutel = ltm->tm_wday;
int heureAcutel = ltm->tm_hour;
int minuteAcutel = ltm->tm_min;

bool periodeJour(int jourDebut, int jourFin);

int selectHeure();
bool calculHeure();

int selectMinuteDebut();
bool calculMinute();

};