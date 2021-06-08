 #pragma once
 #include <arduino.h>

class capteur
{
public:

  int InitAnalog();
  
	int setTemp(int temperature);
  double Convert_temperature(int RawADC);
  
  int detecte_presence();
  int set_timer(int temps);
  void affiche_presence();
	
private:

  float Temp;
  int presence = 0;
  bool hors_gel;
  int timer;
  const int CapteurPresence = 5;
  
};
