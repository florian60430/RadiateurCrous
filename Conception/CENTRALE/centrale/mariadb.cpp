#include "mariadb.h"
#include "mqtt.h"

mariadb *mariadb::singleton = nullptr;

mariadb::mariadb()
{
   char server[50] = "192.168.64.155";
   char user[50] = "flo";
   char password[50] = "123";
   char database[50] = "crous";

   conn = mysql_init(NULL);

   /* Connect to database */
   if (!mysql_real_connect(conn, server, user, password, database, 0, NULL, 0))
   {
      fprintf(stderr, "%s\n", mysql_error(conn));
      exit(1);
   }
}

mariadb::~mariadb()
{
   mysql_close(conn);
}

void mariadb::updateTemperature(char *payload)
{
   MYSQL_ROW row;
   MYSQL_RES *res;

   /*verif topic*/
   char request[100];
   char buffer[100];
   char idDuRadiateur[50];
   char tempRad[50];
   int i = 0;

   strcpy(buffer, payload);

   while (buffer[i] != '%')
   {
      idDuRadiateur[i] = buffer[i];
      i++;
   }
i++;
int j = 0;
  while (buffer[i] != '+')
   {
      tempRad[j] = buffer[i];
      i++;
      j++;
   }
   cout << "id : " << idDuRadiateur << endl;
   cout << "temperature : " << tempRad << endl;


   snprintf(request, 100, "UPDATE `chauffage` SET `temperature`= %s WHERE ID = %s", tempRad, idDuRadiateur);
   printf("\n%s\n", request);
   if (mysql_query(conn, request))
   {
      fprintf(stderr, "%s\n", mysql_error(conn));
      exit(1);
   }
   res = mysql_use_result(conn);
   cout << "la température à bien été enregistré en base" << endl;

   /* close connection */
   mysql_free_result(res);
}

void mariadb::determinePeriode(struct mosquitto *mosq)
{
   int tabJourDebut[500];
   MYSQL_ROW row;
   MYSQL_RES *res;
   int num_fields = mysql_num_fields(res);
   int tabIdRadiateur[1000][2];
   int i = 0;
   int sizeMax = 0;
   char buffer[256];
   char request[500];

   while (1)
   {

      time_t actuel = time(0);
      tm *ltm = localtime(&actuel);

      jourAcutel = ltm->tm_wday;
      heureAcutel = ltm->tm_hour;
      minuteAcutel = ltm->tm_min;

      snprintf(request, 300, "SELECT * FROM `consigne_prog` WHERE %d >= `jour_semaine_debut` AND %d <= `jour_semaine_fin` AND %d >= `heure_debut` AND %d < `heure_fin`", jourAcutel, jourAcutel, heureAcutel, heureAcutel);
      mysql_query(conn, request);

      res = mysql_store_result(conn);

      while (row = mysql_fetch_row(res))
      {
         cout << "le radiateur n° " << row[1] << " doit chauffer à " << row[6] << "°C" << endl;

         strcpy(buffer, row[1]);
         strcat(buffer, "$");
         strcat(buffer, row[6]);
         strcat(buffer, "!");

         mosquitto_publish(mosq, NULL, "consigne/radiateur", strlen(buffer), buffer, 0, false);
      }
      sleep(30);
   }
}

bool mariadb::periodeJour(int jourDebut, int jourFin)
{
   return true;
}
void mariadb::selectALL()
{
}
