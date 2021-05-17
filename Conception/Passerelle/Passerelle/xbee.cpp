#include "xbee.h"
#include <arduino.h>
#include <XBee.h>
xbee::xbee()
{
}

xbee::~xbee()
{

}

int xbee::ReceptionXbee()
{
	int xbee_id[10];
	int count[10];
	int i;
	// toutes les secondes cherche xbee
	Serial.write(xbee_id[i]);
	delay(1000);

	if (xbee_id != 0) {    //
		cout++;
		int reception = Serial.read();
		if (reception != 0)
			Serial.print("(");
		Serial.print(count[i]);
		Serial.println(")");
	}


	return 0;
}

int xbee::sendData()
{
	printf("Data du radiateur envoyer avec sucées !\n");
	return 0;
}