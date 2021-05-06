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
	int getInfoRad(int idRadiateur, int Temperature, int idBat, bool Etat);
	void AfficheInfoRad(int idRadiateur,int Temperature, int idBat, bool Etat);
};

