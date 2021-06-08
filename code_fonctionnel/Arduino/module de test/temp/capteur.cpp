#include "xbee.h"
#include "capteur.h"
#include "consigne.h"
#include <math.h>

// creation des entrées et sorties Analogique
int capteur::InitAnalog(){

  //entrer analogique
  pinMode(CapteurPresence, INPUT);
}

//convertie les données recue par le capteur de Température en degré °C
double capteur::Convert_temperature(int RawADC) 
  {
    Temp = log(((10240000/RawADC) - 10000));
    Temp = 1 / (0.001129148 + (0.000234125 + (0.0000000876741 * Temp * Temp
    ))* Temp );
    Temp = 273.15 - Temp;
    
    return Temp;
  }
  
//permet de detecter une présence ou non / active le mode hors gel si nécessaire
int capteur::detecte_presence(){ 

    if (digitalRead(CapteurPresence) == HIGH){
      presence = 0;
    }else{
      presence = presence + 1 ;
    }
      if (presence >= timer) 
      {
        hors_gel = true;
      }
      if (presence < timer) 
      {
       // Serial.print("time :");
       // Serial.println(presence);
        hors_gel = false;
      } 
    return hors_gel;
}

// set le timer pour la mise en hors gel
int capteur::set_timer(int temps){
  timer=temps;
}

//fonction de test du comptage de timer
void capteur::affiche_presence(){
 // Serial.println(presence);
}
