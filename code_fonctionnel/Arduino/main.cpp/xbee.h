#pragma once
#include "SoftwareSerial.h"
#include <arduino.h>

class xbee
{
  public : 

  void reception_consigne();
  float setConsigne(float newConsigne);
  float getConsigne();
  

  private : 

  int i;
  int messageRecu;
  //char tempRad[100] = "1%27.50+"; // Temperature actuel
  float consigne;
  int jour;
  
};
