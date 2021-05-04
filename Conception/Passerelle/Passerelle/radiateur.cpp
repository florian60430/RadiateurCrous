#include "radiateur.h"
#include "passerelle.h"

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

int radiateur::sendXbee(int idRadiateur, int Temperature, bool Etat, int idBat)
{

	return 0;
}
