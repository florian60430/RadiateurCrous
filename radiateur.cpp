#include "radiateur.h"
#include <iostream>

int radiateur::setConsigne(int idRad, int temp)
{
	xbee Xbee;
	


	
	return  Xbee.send(idRad,temp);
	
	
}


int main(int argc, char ** argv) {
	int idRadiateur;
	int temperature;

	cout << "Valeurs de l'id radiateur ainsi que ça temperature ? "; cin >> idRadiateur >>  temperature;

	 if (idRadiateur !=0 && temperature !=0) {
		 radiateur Rad;
		 Rad.setConsigne(idRadiateur, temperature);
	 }

}
