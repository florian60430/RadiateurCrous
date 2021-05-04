
#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <iostream>
#include "passerelle.h"


int main() {

	int idRad, temp;

	printf("Choisir id du radiateur ? \n");
	scanf_s("%d", &idRad);
	printf("Quelle température voulez vous atteindre? \n");
	scanf_s("%d", &temp);


	if (idRad != 0 && temp != 0) {
		passerelle* test;
		test = new passerelle;
		test->setConsigne(idRad, temp);
		
	}
	system("PAUSE");
}