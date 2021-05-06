#include "passerelle.h"
#include "xbee.h"



passerelle::passerelle()
{
}


passerelle::~passerelle()
{
}

void passerelle::setConsigne(int idRad, int temp, int idBat)
{
	if (idRad != 0 && temp != 0 && idBat != 0)
	{
		printf(" Parametrage radiateur, Success!\n Id_radiateur: %d \n Temperature : %d \n Id_Batiment : %d \n\n", idRad, temp, idBat);
		xbee* sendXbee;
		sendXbee = new xbee;
		int RetourSendXbee = sendXbee->send();
		if (RetourSendXbee == 0) {
			printf("Les consignes du radiateur envoyer avec success!\n");
		}
		else {
			printf("Error ! consigne non envoyer!\n");
		}

	}
	else {
		printf("ERROR");
	}
	
	

}
