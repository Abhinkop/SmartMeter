#include <SoftwareSerial.h>
SoftwareSerial gprsSerial(10, 11);
void setup() {
  // put your setup code here, to run once:
gprsSerial.begin(19200);
  Serial.begin(19200);

  Serial.println("Config SIM900...");
  delay(2000);
  Serial.println("Done!...");
  gprsSerial.flush();
  Serial.flush();


  gprsSerial.println("AT+CMEE=2");
  delay(1000);
  toSerial();
   gprsSerial.println("AT+CSTT");
  delay(1000);
  toSerial();
   gprsSerial.println("AT+CIICR");
  delay(1000);
  toSerial();
   gprsSerial.println("AT+CIFSR");
  delay(1000);
  toSerial();
  gprsSerial.println("AT+CSQ");
  delay(1000);
  toSerial();
  // attach or detach from GPRS service 
  gprsSerial.println("AT+CGATT?");
  delay(1000);
  toSerial();


  // bearer settings
  gprsSerial.println("AT+SAPBR=3,1,\"CONTYPE\",\"GPRS\"");
  delay(2000);
  toSerial();

  // bearer settings
  gprsSerial.println("AT+SAPBR=3,1,\"APN\",\"airtelgprs.com\"");
  delay(3000);
  toSerial();

  // bearer settings
  gprsSerial.println("AT+SAPBR=1,1");
  delay(2000);
  toSerial();

}

void loop() {
  // put your main code here, to run repeatedly:
 // initialize http service
   gprsSerial.println("AT+HTTPINIT");
   delay(2000); 
   toSerial();
  String URL="AT+HTTPPARA=\"URL\",\"http://konsole.netau.net/update.php?meterno=7899194973&reading=0.9&R1=0.12&R2=0\"";
Serial.println(URL);
   gprsSerial.println(URL);
   delay(2000);
   toSerial();

   // set http action type 0 = GET, 1 = POST, 2 = HEAD
   gprsSerial.println("AT+HTTPACTION=0");
   delay(6000);
   toSerial();

   // read server response
   gprsSerial.println("AT+HTTPREAD"); 
   delay(2000);
   toSerial();
   
   //gprsSerial.flush();
  

   gprsSerial.println("");
   gprsSerial.println("AT+HTTPTERM");
   //Serial.println("Serial data starts");
   toSerial();
   delay(300);
   gprsSerial.println("");
   
}
void toSerial()
{
  while(gprsSerial.available()!=0)
  {
    Serial.write(gprsSerial.read());
  }
  //Serial.println();
}
