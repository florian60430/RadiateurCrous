#include "radiateur.h"
#include "passerelle.h"
#include "xbee.h"

radiateur::radiateur()
{
	 idRadiateur;
	 Temperature;
	 Etat;
	 idBat;
}

radiateur::~radiateur()
{
}

int radiateur::getConsigne(int idRadiateur, int Temperature, int idBat)
{

	passerelle* setConsigne;
	setConsigne = new passerelle;
	setConsigne->setConsigne( idRadiateur, Temperature, idBat);
	return 0;
}

int radiateur::getInfoRad(int idRadiateur, int Temperature, int idBat, bool Etat)
{
	radiateur* getInfoRad;
	getInfoRad = new radiateur;
	getInfoRad->AfficheInfoRad(idRadiateur, Temperature, idBat, Etat);
	xbee* getXbee;
	getXbee = new xbee;
	
	int RetourSendXbee = getXbee->send();
	if (RetourSendXbee == 0) {
		printf("Les consignes du radiateur envoyer avec success!\n");
	}
	else {
		printf("Error ! consigne non envoyer!\n");
	}
	return 0;
}

void radiateur::AfficheInfoRad(int idRadiateur, int Temperature, int idBat, bool Etat)
{
	if (Etat == 0) {
			
		printf("\n Info radiateur:\n Id_radiateur: %d \n Temperature : %d \n Id_Batiment : %d \n Etat: Allumer\n", idRadiateur, Temperature, idBat);
		
	}
	else {
		printf(" Info radiateur:\n Id_radiateur: %d \n Temperature : %d \n Id_Batiment : %d \n Etat:Eteint\n", idRadiateur, Temperature, idBat);
	}

	
}
