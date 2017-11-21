#include <EEPROM.h>
 double f=0.00f ;  //Variable to store in EEPROM.
 int eeAddress = 0;   //Location we want the data to be put.
void setup() {

  Serial.begin(9600);
  while (!Serial) {
    ; // wait for serial port to connect. Needed for native USB port only
  }

 
  

  //EEPROM.put(eeAddress, f);
  //One simple call, with the address first and the object second.
  EEPROM.get(eeAddress, f);

  Serial.println(f);

  /** Put is designed for use with custom structures also. **/
}

void loop() {
  /* Empty loop */
  //EEPROM.get(eeAddress, f);
  f=f+1;
 EEPROM.update(eeAddress, f);
  Serial.println(f);
  delay(2048);
}
