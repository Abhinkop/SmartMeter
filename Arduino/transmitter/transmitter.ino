#include <VirtualWire.h>
char inData[8];
int newmessage = 0;
void setup() {

   pinMode(LED_BUILTIN, OUTPUT);
vw_setup(2000);
vw_set_tx_pin(12);
Serial.begin(9600);
}
void loop()
{
  char inData[9]={'-','a', 'r', 'd', 'u', 'i', 'n', 'o', '\0'};
char inChar;
byte index = 1;
char mss[20];
inData[0]='-';
 while(Serial.available() > 0){
       if(index < 16)
       {
           delay(10);
           inChar = Serial.read();
           inData[index] = inChar;
           index++;
           inData[index] = '\0';
       }
           newmessage = 1;
   }
   if(newmessage == 1)
   {
   digitalWrite(LED_BUILTIN, LOW);  
      
           //inData[0] = '-';
           sprintf(mss, "%s", inData);
           vw_send((uint8_t *)mss, strlen(mss));
           vw_wait_tx();
           Serial.println(inData);
           delay(600);
           digitalWrite(LED_BUILTIN, HIGH); 
           newmessage = 0; // Indicate that there is no new message to wait for the new one
   } 
} 
