#include <VirtualWire.h>
#include <LiquidCrystal.h>
LiquidCrystal lcd(12, 11, 5, 4, 3, 2);
void setup()
{
Serial.begin(9600);
Serial.println("Listening");
lcd.begin(16, 2);
lcd.print("Listening");
vw_set_rx_pin(9);
vw_setup(2000);
vw_rx_start();
}
void loop()
{
byte message[VW_MAX_MESSAGE_LEN];
byte messageLength = VW_MAX_MESSAGE_LEN;
//Serial.println("1");
  lcd.clear();
  lcd.print("Listening");
  vw_wait_rx();
  vw_get_message(message, &messageLength);
  lcd.clear();
  //Serial.println("2");
  lcd.setCursor(0, 0);
  // print the number of seconds since reset:
  
  //delay(1000);
for (int i = 0; i < messageLength; i++)
{
Serial.write(message[i]);
lcd.print((char)message[i]);
lcd.setCursor(i, 0);
}
Serial.println();
delay(1000);
}

