#include <math.h>
#include "capteur.h"
#include "consigne.h"
#include "xbee.h"

SoftwareSerial XBee(2, 3);

capteur * donnee = new capteur();
consigne * chauffe = new consigne();
xbee * communication = new xbee();
int power, messageRecu, jour;
int heure = 10;
const int MODE_HORS_GEL = 12;
const int ARRET = 13;
float digit1, digit2, virgule, decimal1, decimal2, consigne, finDeChaine;
double temp;

void setup() {
  Serial.begin(9600);
  pinMode(MODE_HORS_GEL, OUTPUT);
  pinMode(ARRET, OUTPUT);
}

void loop()
{  
      // read the incoming byte:
     
     messageRecu = Serial.read();

     if (messageRecu != -1) 
     {

        if (messageRecu == 43) 
        {
          jour = Serial.read();
          Serial.print("jour : ");
          Serial.println(jour);

          digit1 = Serial.read();
          Serial.print("digit1 : ");
          Serial.println(digit1);
       
          digit2 = Serial.read();
          Serial.print("digit2 : ");
          Serial.println(digit2);

          virgule = Serial.read();
          Serial.print("virgule : ");
          Serial.println(virgule);

          decimal1 = Serial.read();
          Serial.print("decimal1 : ");
          Serial.println(decimal1);

          decimal2 = Serial.read();
          Serial.print("decimal2 : ");
          Serial.println(decimal2);

          finDeChaine = Serial.read();
          Serial.print("fin de chaine : ");
          Serial.println(finDeChaine);
       
          
          if (finDeChaine == 33)
          {
            
           Serial.print("consigne reçu : ");
                  
          consigne = (digit1 - 48) * 10 + (digit2 - 48) + (decimal1-48) / 10 + (decimal2-48) / 100;
          Serial.println(consigne);
          }
          else 
          {
            Serial.println("La chaine à été corompu");
          }
           if( jour == 49) // = 1
        {
          jour = 1; // jour
          
        }else{ // 48 = 0
          jour = 0; // nuit
        }
 
        }
        else 
        {
          Serial.println("Le caractère de début de chaine est incorrect");
        }
       
     }
     else
     {
       Serial.print("Aucun message reçu, consigne actuel : ");
       Serial.println(consigne);
     }

    // read the incoming byte:
   // communication->reception_consigne();
  
      
 
 //Serial.print("temperature : ");
 temp = donnee->Convert_temperature(analogRead(0));
 //Serial.println(temp);

char buffer[100];
   
     strcpy(buffer, 1);
     strcat(buffer, "%");
     strcat(buffer, temp);
     strcat(buffer, "+");

Serial.print(buffer);  
   
  donnee->capteur::set_timer(20);
  
  int tempActuel = donnee->Convert_temperature(analogRead(0));

  bool hors_gel = donnee->capteur::detecte_presence();

  //Serial.print("mode hors_gel :");
  //Serial.println(hors_gel);
  
  chauffe->consigne::put_hors_gel(hors_gel);

  power = chauffe->consigne::consigne_de_chauffe(hors_gel, tempActuel, consigne, heure, power);

  //Serial.println(power);
  
  delay(5000); 
} 
