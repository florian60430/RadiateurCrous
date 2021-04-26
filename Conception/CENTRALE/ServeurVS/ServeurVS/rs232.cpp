#include "rs232.h"


rs232::rs232()
{
	WSADATA wsa;                           // initialisation de WSAS sur windows
	WSAStartup(MAKEWORD(2, 2), &wsa);
}

void rs232::inithandle()
{
	this->hcom = CreateFileA("COM1", GENERIC_READ | GENERIC_WRITE, 0, NULL, OPEN_EXISTING, FILE_FLAG_NO_BUFFERING, NULL);   //3e valeur = s�cu,4e = ouvrir un port existant

	// Paramétrage du port COm 
	if (hcom != INVALID_HANDLE_VALUE)
	{
		DCB conf;

		GetCommState(hcom, &conf);

		conf.BaudRate = CBR_9600;          //on parametre la liaison serie via la structure conf
		conf.StopBits = ONESTOPBIT;
		conf.Parity = NOPARITY;
		conf.ByteSize = 8;
		SetCommState(hcom, &conf);
		COMMTIMEOUTS comm;
		comm.ReadIntervalTimeout = MAXDWORD;
		comm.ReadTotalTimeoutMultiplier = 0;
		comm.ReadTotalTimeoutConstant = 0;
		comm.WriteTotalTimeoutMultiplier = 0;
		comm.WriteTotalTimeoutConstant = 0;
		SetCommTimeouts(hcom, &comm);
	}
}

void rs232::sendtrame(char* trame,int taille)
{
	unsigned long numberofbytewritten;
	
	if (WriteFile(this->hcom, trame, taille, &numberofbytewritten, NULL)) {
		//printf("octetr encvoy� %d .\n", taille);
	}
	else {
		//printf("octetr non envoy� %d .\n", taille);
	}
}

void rs232::getTrameHaut(char trame[])
{
	trame[0] = 0x81;
	trame[1] = 0x01;
	trame[2] = 0x06;
	trame[3] = 0x01;
	trame[4] = 0x06;
	trame[5] = 0x06;
	trame[6] = 0x03;
	trame[7] = 0x01;
	trame[8] = 0xFF;

}

void rs232::getTrameBas(char trame[])
{
	trame[0] = 0x81;         
	trame[1] = 0x01;
	trame[2] = 0x06;
	trame[3] = 0x01;
	trame[4] = 0x16;
	trame[5] = 0x13;
	trame[6] = 0x03;
	trame[7] = 0x02;
	trame[8] = 0xFF;
}
void rs232::getTrameGauche(char trame[])
{
	trame[0] = 0x81;           
	trame[1] = 0x01;
	trame[2] = 0x06;
	trame[3] = 0x01;
	trame[4] = 0x18;
	trame[5] = 0x14;
	trame[6] = 0x01;
	trame[7] = 0x03;
	trame[8] = 0xFF;
}
void rs232::getTrameDroite(char trame[])
{
	trame[0] = 0x81;         
	trame[1] = 0x01;
	trame[2] = 0x06;
	trame[3] = 0x01;
	trame[4] = 0x18;
	trame[5] = 0x14;
	trame[6] = 0x02;
	trame[7] = 0x03;
	trame[8] = 0xFF;
}
void rs232::getTrameZoom(char trame[])
{
	trame[0] = 0x81;         
	trame[1] = 0x01;
	trame[2] = 0x04;
	trame[3] = 0x07;
	trame[4] = 0x02;
	trame[5] = 0xFF;
	
}
void rs232::getTrameDezoom(char trame[])
{
	trame[0] = 0x81; // je met 1 dans la case 0
	trame[1] = 0x01;
	trame[2] = 0x04;
	trame[3] = 0x07;
	trame[4] = 0x03;
	trame[5] = 0xFF;
}
void rs232::getTrameCentre(char trame[])
{
	trame[0] = 0x81;
	trame[1] = 0x01;
	trame[2] = 0x06;
	trame[3] = 0x04;
	trame[4] = 0xFF;
	
}
void rs232::getTrameStart(char trame[])
{
	trame[0] = 0x81;
	trame[1] = 0x01;
	trame[2] = 0x04;
	trame[3] = 0x00;
	trame[4] = 0x02;
	trame[5] = 0xFF;
}
void rs232::getTrameOff(char trame[])
{
	trame[0] = 0x81;
	trame[1] = 0x01;
	trame[2] = 0x04;
	trame[3] = 0x00;
	trame[4] = 0x03;
	trame[5] = 0xFF;
}




	/*}

	if (c == 'e')
	{
		char trame[6];

		trame[0] = 0x81;   //indique le port
		trame[1] = 0x01;
		trame[2] = 0x04;
		trame[3] = 0x00;
		trame[4] = 0x03;
		trame[5] = 0xFF;

		return trame[0];
	}

	if (c == 'h') //vers le haut
	{
		char trame[9];

		trame[0] = 0x81;  //indique le port
		trame[1] = 0x01;
		trame[2] = 0x06;	//haut
		trame[3] = 0x01;
		trame[4] = 0x06;  //gere la vitesse
		trame[5] = 0x06;  //gere la vitesse
		trame[6] = 0x03;
		trame[7] = 0x01;
		trame[8] = 0xFF;

		return trame[0];

	}

	if (c == 'b') //vers le bas
	{
		char trame[9];

		trame[0] = 0x81;   //indique le port
		trame[1] = 0x01;
		trame[2] = 0x06;
		trame[3] = 0x01;
		trame[4] = 0x06;
		trame[5] = 0x06;   //bas
		trame[6] = 0x03;
		trame[7] = 0x02;
		trame[8] = 0xFF;

		return trame[0];

	}

	if (c == 'd')
	{
		char trame[9];

		trame[0] = 0x81;   //indique le port
		trame[1] = 0x01;
		trame[2] = 0x06;   //droite
		trame[3] = 0x01;
		trame[4] = 0x18;
		trame[5] = 0x14;
		trame[6] = 0x02;
		trame[7] = 0x03;
		trame[8] = 0xFF;

		return trame[0];
	}

	if (c == 'g')
	{
		char trame[9];

		trame[0] = 0x81;   //indique le port
		trame[1] = 0x01;
		trame[2] = 0x06;
		trame[3] = 0x01;   //gauche
		trame[4] = 0x06;
		trame[5] = 0x06;
		trame[6] = 0x01;
		trame[7] = 0x03;
		trame[8] = 0xFF;

		return trame[0];
	}

	if (c == 'c')
	{
		char trame[5];

		trame[0] = 0x81;   //indique le port
		trame[1] = 0x01;
		trame[2] = 0x06;   //droite
		trame[3] = 0x04;
		trame[4] = 0xFF;

		return trame[0];
		
	}

	if (c == '+')
	{
		char trame[6];

		trame[0] = 0x81;   //indique le port
		trame[1] = 0x01;
		trame[2] = 0x04;   //droite
		trame[3] = 0x07;
		trame[4] = 0x02;
		trame[5] = 0xFF;

		return trame[0];

	}

	if (c == '-')
	{
		char trame[6];
		
		trame[0] = 0x81;   //indique le port
		trame[1] = 0x01;
		trame[2] = 0x04;   //droite
		trame[3] = 0x07;
		trame[4] = 0x03;
		trame[5] = 0xFF;

		return trame[0];

	}*/

	
