#include "mqtt.h"
#include "mariadb.h"
#include <stdio.h>
#include <stdlib.h>
#include <string.h>

int main()
{
	int idRad;
	char request[500], tempActuel[500];
	std::string jour;
	MYSQL *conn = mysql_init(NULL);
	MYSQL_ROW row;
	MYSQL_RES *res;

	time_t actuel = time(0);
	tm *ltm = localtime(&actuel);

	int jourActuel = ltm->tm_wday;
	int heureActuel = ltm->tm_hour;
	int minuteActuel = ltm->tm_min;

	switch (jourActuel)
	{
	case 1:
		jour = "Lundi";
		break;
	case 2:
		 jour = "Mardi";
		 break;
	case 3:
		jour = "Mercredi";
		break;
	case 4:
		jour = "Jeudi";
		break;
	case 5:
		jour= "Vendredi";
		break;
	case 6:
		jour = "Samedi";
		break;
	case 7:
	    jour = "Dimanche";
		break;
	}

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

	cout << "connexion au serveur mariadb " << "192.168.64.155" << endl;

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

	cout << "Nous sommes : " << jour << " " << heureActuel << "h" << minuteActuel << endl;

	cout << "Entrez l'id du chauffa dont vous voulez compter le nombre de consignes qui doivent être actif" << endl;
	cin >> idRad;

	snprintf(request, 500, "SELECT COUNT(*) FROM `consigne_prog` WHERE debut <= '%s' AND fin >= '%s' AND ID_chauffages = %d", tempActuel, tempActuel, idRad);
	//printf("%s\n", request);
	mysql_query(conn, request);
	res= mysql_store_result(conn);
	row = mysql_fetch_row(res);

	cout << "Le radiateur n° " << idRad << " possède " << row[0] << " consignes qui doivent être actif" << endl;
}
