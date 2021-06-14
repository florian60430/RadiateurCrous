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
     messageRecu = Serial.read();
         
      if (messageRecu != -1) 
     {
        if (messageRecu == 122) 
        {
          idDigit1 = Serial.read();
          idDigit2 = Serial.read();
          idDigit3 = Serial.read();

         if (id == ((idDigit1-48) *100 + (idDigit2 -48) *10 + (idDigit3-48)))
         {
          isGood = true;

          plus = Serial.read();       
          digit1 = Serial.read();       
          digit2 = Serial.read();
          virgule = Serial.read();
          decimal1 = Serial.read();
          decimal2 = Serial.read();
          finDeChaine = Serial.read();
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
            consigne = (digit1 - 48) * 10 + (digit2 - 48) + (decimal1-48) / 10 + (decimal2-48) / 100;
          }
          else 
          {
          }
        }
        else 
        {
        }
        }
        else 
        {
        }
     }
     else
     {
     }
 
 temp = donnee->Convert_temperature(analogRead(0));

  donnee->capteur::set_timer(80);
  
  int hors_gel = donnee->capteur::detecte_presence();


char tmp[50];
dtostrf(temp, 4, 2, tmp);
snprintf(tram, 50, "%d+%s@%d#\0", id, tmp, hors_gel);
  
  chauffe->consigne::put_hors_gel(hors_gel);

  power = chauffe->consigne::consigne_de_chauffe(hors_gel, temp, consigne, heure, power);

  compteur ++;

result = compteur % 10;
if (result == 0)
{
  Serial.println(tram);
}
  delay(500); 
} 
