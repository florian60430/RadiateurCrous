
#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <iostream>
#include "passerelle.h"
#include "radiateur.h"

using namespace std;


int main() {
	
	int idRad, temp, idBat,menu;
	bool Etat = 0;

	do
	{
		cout << endl << " ----------------------- MENU -----------------------" << endl << endl;
		cout << "1. Entrer consigne pour radiateur" << endl;
		cout << "2. Affiche information radiateur" << endl;
		cout << "0. Quitter" << endl << endl;
		cout << "Choix : ";
		cin >> menu;
		cout << endl;

		switch (menu)
		{
		case 0: break;

		

		case 1: cout << endl << "Choisir id du radiateur: \n";
			cin >> idRad;
			cout << endl;
			cout << endl << "Choisir id du batiment: \n";
			cin >> idBat;
			cout << endl;
			cout << endl << "Quelle température voulez vous atteindre? \n";
			cin >> temp;
			cout << endl;
			if (idRad != 0 && temp != 0 && idBat != 0) {
				radiateur* ConsigneRad;
				ConsigneRad = new radiateur;
				ConsigneRad->getConsigne(idRad, temp, idBat); //Recup les consigne entrée

			}
			break;

		case 2:
			cout << endl << "Choisir id du radiateur: \n";
			cin >> idRad;
			cout << endl << "Choisir id du batiment: \n";
			cin >> idBat;
			cout << endl;
			if (idRad != 0 && idBat != 0) {
				radiateur* InfoRad;
				InfoRad = new radiateur;
				InfoRad->getInfoRad(idRad, temp, idBat, Etat); //Affiche donner Radiateur

			}

			
			break;

		

			
		}

	} while (menu != 0);

	
	//Consigne à entrée

	
}