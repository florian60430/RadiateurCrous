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
	printf("Success! Parametrage temperature envoyer a radiateur Id_radiateur: %d | Temperature : %d | Id_Batiment : %d \n",idRad, temp, idBat);
	xbee* sendXbee;
	sendXbee = new xbee;
	sendXbee->send();

	

}
