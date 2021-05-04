
#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <iostream>
#include "passerelle.h"
#include "radiateur.h"


int main() {

	int idRad, temp, idBat;
	//Consigne à entrée
	printf("Choisir id du radiateur: \n");
	scanf_s("%d", &idRad);
	printf("Choisir id du batiment: \n");
	scanf_s("%d", &idBat);

	printf("Quelle température voulez vous atteindre? \n");
	scanf_s("%d", &temp);


	if (idRad != 0 && temp != 0 && idBat != 0) {
		radiateur* ConsigneRad;
		ConsigneRad = new radiateur;
		ConsigneRad->getConsigne(idRad, temp, idBat); //Recup les consigne entrée
	
	}
	system("PAUSE");
}