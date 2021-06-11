#include <math.h>
#include "capteur.h"
#include "consigne.h"
#include "xbee.h"

SoftwareSerial XBee(2, 3);

capteur * donnee = new capteur();
consigne * chauffe = new consigne();
xbee * communication = new xbee();
int power, messageRecu;
int heure = 10;
const int MODE_HORS_GEL = 12;
const int ARRET = 13;
float digit1, digit2, virgule, decimal1, decimal2, plus, consigne, finDeChaine, idDigit1, idDigit2, idDigit3;
char tram[500];
int id = 1, compteur = 0, result;
double temp;
bool isGood;

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
        if (messageRecu == 122) 
        {
          idDigit1 = Serial.read();
          //Serial.print("id digit 1 :");
          //Serial.println(idDigit1);

          idDigit2 = Serial.read();
          //Serial.print("id digit 2 :");
          //Serial.println(idDigit2);

          idDigit3 = Serial.read();
          //Serial.print("id digit 3 : ");
          //Serial.println(idDigit3);

         if (id == ((idDigit1-48) *100 + (idDigit2 -48) *10 + (idDigit3-48)))
         {
          isGood = true;

           plus = Serial.read();
         // Serial.print("plus : ");
          //Serial.println(plus);
          
          digit1 = Serial.read();
          //Serial.print("digit1 : ");
          //Serial.println(digit1);
       
          digit2 = Serial.read();
          //Serial.print("digit2 : ");
         // Serial.println(digit2);

          virgule = Serial.read();
          //Serial.print("virgule : ");
          //Serial.println(virgule);

          decimal1 = Serial.read();
         // Serial.print("decimal1 : ");
          //Serial.println(decimal1);

          decimal2 = Serial.read();
          //Serial.print("decimal2 : ");
          //Serial.println(decimal2);

          finDeChaine = Serial.read();
          //Serial.print("fin de chaine : ");
          //Serial.println(finDeChaine);

         }
         else
         {
          
          for (int i=0; i<8; i++)
          {
            Serial.read();
          }
          isGood = false;
         }
         
       if (id == isGood)
       {
          
          if (finDeChaine == 33)
          {      
            //Serial.print("consigne reçu : ");
                  
            consigne = (digit1 - 48) * 10 + (digit2 - 48) + (decimal1-48) / 10 + (decimal2-48) / 100;
            //Serial.println(consigne);
          
          }
          else 
          {
            //Serial.println("La chaine à été corompu");
          }

        }
        else 
        {
          //Serial.print("l'id n'est pas le notre consigne actuel : ");
          //Serial.println(consigne);
        }
          
        }
        else 
        {
          //Serial.println("Le caractère de début de chaine est incorrect");
        }
        
     }
     else
     {
       //Serial.print("Aucun message reçu, consigne actuel : ");
       //Serial.println(consigne);
     }

    // read the incoming byte:
   // communication->reception_consigne();

   
 //Serial.print("temperature : ");
 
 temp = donnee->Convert_temperature(analogRead(0));
 //Serial.println(temp);
  donnee->capteur::set_timer(80);
  
  int tempActuel = donnee->Convert_temperature(analogRead(0));

  int hors_gel = donnee->capteur::detecte_presence();



char tmp[50];
dtostrf(temp, 4, 2, tmp);
snprintf(tram, 50, "%d+%s@%d#\0", id, tmp, hors_gel);

result = compteur % 10;
if (result == 0)
{
  Serial.println(tram);
}  
  chauffe->consigne::put_hors_gel(hors_gel);

  power = chauffe->consigne::consigne_de_chauffe(hors_gel, tempActuel, consigne, heure, power);

  //Serial.println(power);
  compteur ++;
  delay(500); 
} 
