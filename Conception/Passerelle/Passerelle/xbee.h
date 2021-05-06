#pragma once

#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <iostream>


class xbee
{
private:
	int xbee_id;

public:

	xbee();
	~xbee();
	int ReceptionXbee();
	int sendData(); //Send les consigne au xbee
	int readData();
};
