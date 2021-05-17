#pragma once

#include <stdio.h>
#include <stdlib.h>
#include <string.h>
class passerelle
{
private:
	int idPasserelle;
	
public:
	passerelle();
	~passerelle();
	int connectMQTT(chat *host, int port, int keepalive);
	void setConsigne(int idRad, int temp, int idBat);
	int getTemp();
};

