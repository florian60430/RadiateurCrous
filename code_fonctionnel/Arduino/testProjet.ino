 #include "SoftwareSerial.h"

SoftwareSerial XBee(2, 3);


//int incomingByte = 0;
int i;
int messageRecu;
char tempRad[100] = "1%27.50+"; // Temperature actuel
float digit1, digit2, virgule, decimal1, decimal2, consigne, finDeChaine;
int jour;
void setup()
{
  // Baud rate MUST match XBee settings (as set in XCTU)
 Serial.begin(9600);

  delay(1000);
 
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
          Serial.print("jour : "); Serial.println(jour);
          digit1 = Serial.read();
          Serial.print("digit1 : "); Serial.println(digit1);
          digit2 = Serial.read();
          Serial.print("digit2 : "); Serial.println(digit2);
          virgule = Serial.read();
          Serial.print("virgule : "); Serial.println(virgule);
          decimal1 = Serial.read();
          Serial.print("decimal1 : "); Serial.println(decimal1);
          decimal2 = Serial.read();
          Serial.print("decimal2 : "); Serial.println(decimal2);
          finDeChaine = Serial.read();
          Serial.print("finDeChaine : "); Serial.println(finDeChaine);
          
          if (finDeChaine == 33)
          {
                  
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
       Serial.println("Aucun message reçu");
     }

  delay(10000);

}
