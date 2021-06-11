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

	cout << "listage de la table 'chauffage'" << endl;

	if (mysql_query(conn, "SELECT * from chauffage"))
	{
		fprintf(stderr, "%s\n", mysql_error(conn));
		exit(1);
	}

	res = mysql_store_result(conn);
	while (row = mysql_fetch_row(res))
	{
		cout << row[0] << " " << row[1] << " " << row[2] << " " <<row[3] << endl;
	}
}
