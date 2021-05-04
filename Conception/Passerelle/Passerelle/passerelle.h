#pragma once

#include <stdio.h>
#include <stdlib.h>
#include <string.h>
class passerelle
{
	
public:
	passerelle();
	~passerelle();
	void setConsigne(int idRad, int temp);
	int getTemp();
};

