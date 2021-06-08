#include <math.h>

int presence = 0;
const int buttonPin = 2;

void setup() {
  pinMode(buttonPin, INPUT);
  Serial.begin(9600);
}

void loop()
{ 
 int hors_gel;
 int timer = 20;
 
  while (presence < timer){
    if (digitalRead(buttonPin) == HIGH){
      Serial.println(presence);
      presence = 0;
      Serial.print("mode hors gel =");
      Serial.println(hors_gel);
    }else{
      presence = presence + 1 ;
      Serial.println(presence);
      Serial.print("mode hors gel =");
      Serial.println(hors_gel);
      delay(1000);
    }
  }  
  
presence = timer;

  if (presence = timer){
    hors_gel = 1;
    Serial.print("mode hors gel =");
    Serial.println(hors_gel);
    
    if (digitalRead(buttonPin) == HIGH){
    hors_gel = 0;
    presence = 0;
  }
 } 
} 
