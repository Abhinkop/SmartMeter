#include <VirtualWire.h>
int j=0;
void setup()
{
Serial.begin(9600);
Serial.println("Listening");
vw_set_rx_pin(9);
vw_setup(2000);
vw_rx_start();
}
void loop()
{
byte message[VW_MAX_MESSAGE_LEN];
byte messageLength = VW_MAX_MESSAGE_LEN;
//Serial.println("1");
  vw_wait_rx();
  vw_get_message(message, &messageLength);
  //Serial.println("2");
for (int i = 0; i < messageLength; i++)
{
Serial.write(message[i]);
}
Serial.print(j);
j++;
Serial.println();
}

