#pragma once
class radiateur
{
	private:
		int idRadiateur;
		int Temperature;
		bool Etat;
		int idBat;

	public:

		radiateur();
		~radiateur();
		int getConsigne(int idRadiateur, int Temperature, int idBat); //Recupére consigne
		int AllumeRad();
		int sendXbee(int idRadiateur, int Temperature, bool Etat, int idBat); //Send les consigne au xbee
};

