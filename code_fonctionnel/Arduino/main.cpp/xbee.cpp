#include "xbee.h"
#include "capteur.h"
#include "consigne.h"

void xbee::reception_consigne(){

    // read the incoming byte:
     int jour, messageRecu;
     float digit1, digit2, virgule, decimal1, decimal2, finDeChaine, temperatureConsigne;
     messageRecu = Serial.read();

     if (messageRecu != -1) 
     {

        if (messageRecu == 43) 
        {
          jour = Serial.read();

          digit1 = Serial.read();

          digit2 = Serial.read();
 
          virgule = Serial.read();
      
          decimal1 = Serial.read();

          decimal2 = Serial.read();
 
          finDeChaine = Serial.read();
          
          if (finDeChaine == 33)
          {
            Serial.println("consigne reçu :");
            temperatureConsigne = (digit1 - 48) * 10 + (digit2 - 48) + (decimal1-48) / 10 + (decimal2-48) / 100;
            Serial.println(temperatureConsigne);
          }
          else 
          {
            Serial.println("La chaine à été corompu");
          }
 
        }
        else 
        {
          Serial.println("Le caractère de début de chaine est incorrect");
        }
       
     }
     else
     {
       Serial.println("Aucun message reçu");
       Serial.println(temperatureConsigne);

     }
  
}

float xbee::getConsigne()
{
 return consigne;
}
