
#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <iostream>
#include "passerelle.h"
#include "radiateur.h"


int main() {

	int idRad, temp, idBat;
	//Consigne � entr�e
	printf("Choisir id du radiateur: \n");
	scanf_s("%d", &idRad);
	printf("Choisir id du batiment: \n");
	scanf_s("%d", &idBat);

	printf("Quelle temp�rature voulez vous atteindre? \n");
	scanf_s("%d", &temp);


	if (idRad != 0 && temp != 0 && idBat != 0) {
		radiateur* ConsigneRad;
		ConsigneRad = new radiateur;
		ConsigneRad->getConsigne(idRad, temp, idBat); //Recup les consigne entr�e
	
	}
	system("PAUSE");
}