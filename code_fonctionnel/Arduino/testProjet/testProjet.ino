#include <math.h>
#include "IdGuard.h"
#define DEVICE_ID 2

void setup() {
  Serial.begin(9600);

   // Optional offset to write ID in 4th byte from the end in EEPROM.
  // Defaults to 0, which means ID is stored in last byte in EEPROM.
  IdGuard.offset = 3;

  // Writes DEVICE_ID to EEPROM memory.
  // LED defined by error_led_pin blinks I and D letters in Morse code "..|-..".
  // Restarts device to prevent execution of any following code.
  // Comment out this line after ID is successfully stored in EEPROM.
  // IdGuard.writeIdAndRestartDevice(DEVICE_ID);

  // Checks DEVICE_ID against last byte in EEPROM memory.
  // Blinks I and D in morse code "..|-.."and restarts device in case of
  // mismatch to prevent execution of any following code.
  IdGuard.forceId(DEVICE_ID);

  // Only reads ID from EEPROM.
  uint8_t device_id = IdGuard.readId();
}

void loop()
{    
  uint8_t device_id = IdGuard.readId();
      // read the incoming byte:
 
Serial.println(device_id);     
          
        
  
  delay(1000); 
} 
