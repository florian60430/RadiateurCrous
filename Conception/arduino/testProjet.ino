#include "SoftwareSerial.h"

SoftwareSerial XBee(2, 3);

char c;
int val_asc;
int incomingByte = 0;

void setup()
{
  // Baud rate MUST match XBee settings (as set in XCTU)
 Serial.begin(9600);
  Serial.println("Arduino reçoit du pi via xbee");
  XBee.begin(9600);
  delay(1000);
 
}

void loop()
{
 

 if (Serial.available() > 0) {
    // read the incoming byte:
    incomingByte = Serial.read();

    // say what you got:
    Serial.print("I received: ");
    Serial.println(incomingByte, DEC);
  }
  else
  {
    Serial.println("Coucou de arduino");
     Serial.println(XBee.read());
  }
  
  delay(1000);
  

     
 

}
