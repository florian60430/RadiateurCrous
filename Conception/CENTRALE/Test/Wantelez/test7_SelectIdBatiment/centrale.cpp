#include "mqtt.h"
#include "mariadb.h"
#include <stdio.h>
#include <stdlib.h>
#include <string.h>

int main()
{
	int idRad;
	char request[500];
	MYSQL *conn = mysql_init(NULL);
	MYSQL_ROW row;
	MYSQL_RES *res;

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

	cout << "Entrez l'id du radiateur " << endl;
	cin >> idRad;

	snprintf(request, 500, "SELECT batiment.ID FROM batiment INNER JOIN appartement ON batiment.ID = appartement.ID_batiment INNER JOIN chauffage ON appartement.ID = chauffage.ID_appartement WHERE chauffage.ID = %d ",
			 idRad);
	mysql_query(conn, request);
	res = mysql_store_result(conn);
	row = mysql_fetch_row(res);

	cout << "Le radiateur n° " << idRad << " est dans le batiment " << row[0] << endl;
}
