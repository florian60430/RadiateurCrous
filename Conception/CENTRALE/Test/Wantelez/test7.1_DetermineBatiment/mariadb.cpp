#include "mariadb.h"
#include "mqtt.h"

mariadb *mariadb::singleton = nullptr;

mariadb::mariadb()
{
   conn = mysql_init(NULL);

   /* Connexion base de donnée */
   if (!mysql_real_connect(conn, "192.168.64.155", "flo", "123", "crous", 0, NULL, 0))
   {
      fprintf(stderr, "Impossible de se connecter a la bdd %s\n", mysql_error(conn));
      exit(1);
   }
}

mariadb::~mariadb()
{
   mysql_close(conn);
}

/*Modifier l'état*/
void mariadb::updateEtat(char *idRad, char *horsgel)
{
   MYSQL_ROW row;
   MYSQL_RES *res;

   if (horsgel[0] != tmp)
   {
      if (horsgel[0] == '1')
      {
         snprintf(request, 100, "UPDATE `chauffage` SET `etat`='OFF' WHERE ID = %s", idRad);
      }
      else if (horsgel[0] == '0')
      {
         snprintf(request, 100, "UPDATE `chauffage` SET `etat`='ON' WHERE ID = %s", idRad);
      }
      //  printf("%s", request);
      mysql_query(conn, request);
   }
   tmp = horsgel[0];
}

/*Modifier la température */
void mariadb::updateTemperature(char *idRad, char *tempRad)
{
   MYSQL_ROW row;
   MYSQL_RES *res;

   /* Mise à jour de la température du radiateur en base */
   snprintf(request, 100, "UPDATE `chauffage` SET `temperature`= %s WHERE ID = %s", tempRad, idRad);
   if (mysql_query(conn, request))
   {
      fprintf(stderr, "%s\n", mysql_error(conn));
      exit(1);
   }
   res = mysql_use_result(conn);
   cout << "la température à bien été enregistré en base" << endl;

   mysql_free_result(res);
}

/* Selection des id des radiateurs */
MYSQL_RES *mariadb::selectIdChauffage(MYSQL_RES *resIdRadiateur)
{
   mysql_query(conn, "SELECT ID from `chauffage`");
   resIdRadiateur = mysql_store_result(conn);
   return resIdRadiateur;
}

/* Compte le nombre de consigne total du radiateur */
MYSQL_ROW mariadb::compteNbConsigne()
{
   MYSQL_RES *resNbConsigne;
   MYSQL_ROW rowNbConsigne;

   snprintf(request, 300, "SELECT COUNT(*) from `consigne_prog` WHERE ID_chauffages = %d", idRad);
   mysql_query(conn, request);

   resNbConsigne = mysql_store_result(conn);
   rowNbConsigne = mysql_fetch_row(resNbConsigne);

   return rowNbConsigne;
}

/* Compte le nombre de consigne qui doivent être actif maintenant pour chaque radiateur */
MYSQL_ROW mariadb::compteNbConsigneProg()
{

   MYSQL_RES *resVerifConsigne;
   MYSQL_ROW rowVerifConsigne;

   snprintf(request, 500, "SELECT COUNT(*) FROM `consigne_prog` WHERE debut <= '%s' AND fin >= '%s' AND ID_chauffages = %d", tempActuel, tempActuel, idRad);
   //printf("%s\n", request);
   mysql_query(conn, request);
   resVerifConsigne = mysql_store_result(conn);
   rowVerifConsigne = mysql_fetch_row(resVerifConsigne);

   return rowVerifConsigne;
}

/* Selection l'id du batiment dans lequel le chauffage est situé */
MYSQL_ROW mariadb::selectIdBat()
{
   MYSQL_RES *resBatiment;
   MYSQL_ROW rowBatiment;

   snprintf(request, 500, "SELECT batiment.ID FROM batiment INNER JOIN appartement ON batiment.ID = appartement.ID_batiment INNER JOIN chauffage ON appartement.ID = chauffage.ID_appartement WHERE chauffage.ID = %d ",
            idRad);
   mysql_query(conn, request);
   resBatiment = mysql_store_result(conn);
   rowBatiment = mysql_fetch_row(resBatiment);

   return rowBatiment;
}

/* Selectionne le nombre de degres de la consigne de base du jour */
MYSQL_ROW mariadb::selectDegreConsigneJour()
{
   MYSQL_RES *resConsigneBaseJour;
   MYSQL_ROW rowConsigneBaseJour;

   mysql_query(conn, "SELECT degres_jour FROM config");
   resConsigneBaseJour = mysql_store_result(conn);
   rowConsigneBaseJour = mysql_fetch_row(resConsigneBaseJour);

   return rowConsigneBaseJour;
}

MYSQL_ROW mariadb::selectDegreConsigneNuit()
{
   MYSQL_RES *resConsigneBaseNuit;
   MYSQL_ROW rowConsigneBaseNuit;

   mysql_query(conn, "SELECT degres_nuit FROM config");
   resConsigneBaseNuit = mysql_store_result(conn);
   rowConsigneBaseNuit = mysql_fetch_row(resConsigneBaseNuit);

   return rowConsigneBaseNuit;
}

/* Selection les consigne du radiateur qui doivent être actif maintenant */
MYSQL_ROW mariadb::selectConsigne()
{

   MYSQL_RES *resConsigne;
   MYSQL_ROW rowConsigne;

   snprintf(request, 500, "SELECT * FROM consigne_prog WHERE debut <= %s AND fin >= %s AND ID_chauffages = %d", tempActuel, tempActuel, idRad);
   //printf("%s\n", request);
   mysql_query(conn, request);

   resConsigne = mysql_store_result(conn);
   rowConsigne = mysql_fetch_row(resConsigne);

   return rowConsigne;
}

/* Détermine et envoi quelle consigne chaque radiateur doit suivre */
void mariadb::determinePeriode(struct mosquitto *mosq)
{
   MYSQL_ROW rowConsigne, rowBatiment, rowIdRadiateur, rowNbConsigne, rowConsigneBase, rowVerifConsigne;
   MYSQL_RES *resConsigne, *resBatiment, *resIdRadiateur, *resNbConsigne, *resConsigneBase, *resVerifConsigne;

   char buffer[256], request[500], topic[500];

   /* mise a jour de l'heure */
   updateHeure();

   /* selection des id des radiateur */
   resIdRadiateur = selectIdChauffage(resIdRadiateur);

   while (rowIdRadiateur = mysql_fetch_row(resIdRadiateur))
   {
      idRad = atoi(rowIdRadiateur[0]);

      rowNbConsigne = compteNbConsigne();
      rowBatiment = selectIdBat();
      /* Si le radiateur n'a aucune consigne */
      if (atoi(rowNbConsigne[0]) == 0)
      {
         /* Si on est la nuit */
         if (heureActuel <= 6 || heureActuel >= 22)
         {
            rowConsigneBase = selectDegreConsigneNuit();
         }
         else
         {
            rowConsigneBase = selectDegreConsigneJour();
         }

         //  cout << "le radiateur n° " << rowIdRadiateur[0] << " doit chauffer à " << rowConsigneBase[0] << "°C batiment " << rowBatiment[0] << endl;

         mariadb::constructBufferTemp(buffer, atof(rowConsigneBase[0]));

         snprintf(topic, 300, "batiment%d/consigne/radiateur", atoi(rowBatiment[0]));
         mosquitto_publish(mosq, NULL, topic, strlen(buffer), buffer, 0, false);
      }

      else
      {
         /* on détermine si une de ses consigne peut être actif maintenant */
         rowVerifConsigne = compteNbConsigneProg();

         /* si le radiateur n'a aucune consigne qui doit être actif maintenant */
         if (atoi(rowVerifConsigne[0]) == 0)
         {
            /* Si on est la nuit*/
            if (heureActuel <= 6 || heureActuel >= 22)
            {
               rowConsigneBase = selectDegreConsigneNuit();
            }
            else
            {
               rowConsigneBase = selectDegreConsigneJour();
            }

            rowBatiment = selectIdBat();

            // cout << "le radiateur n° " << rowIdRadiateur[0] << " doit chauffer à " << rowConsigneBase[0] << "°C batiment " << rowBatiment[0] << endl;
            mariadb::constructBufferTemp(buffer, atof(rowConsigneBase[0]));
            snprintf(topic, 300, "batiment%d/consigne/radiateur", atoi(rowBatiment[0]));
            mosquitto_publish(mosq, NULL, topic, strlen(buffer), buffer, 0, false);
         }

         else
         {
            /* Si le radiateur à une consigne qui doit être actif maintenant */
            rowConsigne = selectConsigne();

            // cout << "le radiateur n° " << rowIdRadiateur[0] << " doit chauffer à " << rowConsigne[4] << "°C batiment " << rowBatiment[0] << endl;

            mariadb::constructBufferTemp(buffer, atof(rowConsigne[4]));
            rowConsigne = selectIdBat();

            snprintf(topic, 300, "batiment%d/consigne/radiateur", atoi(rowBatiment[0]));
            mosquitto_publish(mosq, NULL, topic, strlen(buffer), buffer, 0, false);
         }
      }
   }
}

void mariadb::constructBufferTemp(char *buffer, float consigne)
{

   char tabConsigne[50];

      snprintf(buffer, 50, "le radiateur N° %d est dans ce batiment", idRad);

}

int mariadb::calculJourNuit()
{
   return 1;
}

void mariadb::updateHeure()
{
   time_t actuel = time(0);
   tm *ltm = localtime(&actuel);

   jourActuel = ltm->tm_wday;
   heureActuel = ltm->tm_hour;
   minuteActuel = ltm->tm_min;

   char cjourActuel[50], cheureActuel[50], cminuteActuel[50];

   snprintf(cjourActuel, 50, "%d", jourActuel);

   if (heureActuel < 10)
   {
      snprintf(cheureActuel, 50, "0%d", heureActuel);
   }
   else
   {
      snprintf(cheureActuel, 50, "%d", heureActuel);
   }

   if (minuteActuel < 10)
   {
      snprintf(cminuteActuel, 50, "0%d", minuteActuel);
   }
   else
   {
      snprintf(cminuteActuel, 50, "%d", minuteActuel);
   }

   snprintf(tempActuel, 50, "%s%s%s", cjourActuel, cheureActuel, cminuteActuel);

   // printf("l'heure actuel est : %s\n", tempActuel);
   cout << tempActuel << endl;
}
