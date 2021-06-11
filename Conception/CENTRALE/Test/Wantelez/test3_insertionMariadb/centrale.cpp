#include "mqtt.h"
#include "mariadb.h"
#include <stdio.h>
#include <stdlib.h>
#include <string.h>

int main()
{
	int temperature;
	char request[500];
	MYSQL *conn = mysql_init(NULL);

	cout << "connexion au serveur mariadb "
		 << "192.168.64.155" << endl;

	/* Connexion base de donnée */
	if (!mysql_real_connect(conn, "192.168.64.155", "flo", "123", "crous", 0, NULL, 0))
	{
		fprintf(stderr, "Impossible de se connecter a la bdd %s\n", mysql_error(conn));
		exit(1);
	}
	else
	{
		cout << "connexion reussi" << endl;
	}

	cout << "quelle température voulez mettre pour le radiateur 1 ?" << endl;
	cin >> temperature ;
	
	snprintf(request, 100, "UPDATE `chauffage` SET `temperature`= %d WHERE ID = 1", temperature);
	printf("\n%s\n", request);
  if (mysql_query(conn, request))
   {
      fprintf(stderr, "%s\n", mysql_error(conn));
      exit(1);
   }
   else
   {
	   cout << "la température à été modifié avec succès" << endl;
   }
}
