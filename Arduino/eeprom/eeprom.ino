#include <EEPROM.h>
float x;
void setup() {
  // put your setup code here, to run once:
 Serial.begin(9600);
 EEPROM.get(50, x);
 if(isnan(x))
 x=0;
 Serial.println(x);
 x++;
 EEPROM.put(50, x);
 
}

void loop() {
  // put your main code here, to run repeatedly:

}
