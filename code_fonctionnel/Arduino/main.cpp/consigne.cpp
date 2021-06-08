#include "xbee.h"
#include "capteur.h"
#include "consigne.h"

// creation des entrées et sorties Analogique
int consigne::InitAnalog(){
  
  pinMode(MODE_HORS_GEL, OUTPUT);
  pinMode(ARRET, OUTPUT);
}

// active / desactive le mode hors_gel
int consigne::put_hors_gel(bool hors_gel){

  if( hors_gel == 1){
    digitalWrite(MODE_HORS_GEL,HIGH);
  }else if(hors_gel == 0){
    digitalWrite(MODE_HORS_GEL,LOW);
  }
  return hors_gel;
}

// controle le marche / arret du radiateur
int consigne::consigne_de_chauffe(bool hors_gel, int tempActuel, float consigneRad, int heure, int power){
  
  /*if(heure < 6 || heure > 22){
    consigneRad = 16;
  }*/
  
  if(tempActuel < consigneRad || hors_gel == 1){
    digitalWrite(ARRET,LOW); 
    power = 1;
   // Serial.println("chauffage en fonctionnement");
  }else if (tempActuel > consigneRad ){
    digitalWrite(ARRET,HIGH);  
    power = 0;
   // Serial.println("chauffage à l'arret");
  }

  return power;
}
