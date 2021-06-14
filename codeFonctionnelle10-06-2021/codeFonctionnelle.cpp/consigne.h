#pragma once
#include <arduino.h>

class consigne
{
  public:

  int InitAnalog();
  
  int put_hors_gel(bool hors_gel);
  int consigne_de_chauffe(bool hors_gel , float tempActuel, float consigneRad, int heure, int power);

  private:
  
    bool hors_gel;

    const int MODE_HORS_GEL = 12;
    const int ARRET = 13;
};
