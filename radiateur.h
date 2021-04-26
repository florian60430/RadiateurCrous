#pragma once
#include "xbee.h"
class radiateur:xbee
{ 
	private:

		int idRad;
	public:
		
		radiateur();
		int setConsigne(int idRad, int temp);



};

