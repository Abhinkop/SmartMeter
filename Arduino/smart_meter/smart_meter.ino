#include <EmonLib.h>

#include <EEPROM.h>

#include <SoftwareSerial.h>
SoftwareSerial gprsSerial(7, 8);
//SIM900 Tx-->7 Rx-->8
EnergyMonitor emon1;       

void setup()
{
  gprsSerial.begin(19200);
  Serial.begin(19200);
  emon1.current(A1, 30);             // Current: input pin, calibration.
  Serial.println("Config SIM900...");
  delay(2000);
  Serial.println("Done!...");
  gprsSerial.flush();
  Serial.flush();

  // attach or detach from GPRS service 
  gprsSerial.println("AT+CGATT?");
  delay(100);
  toSerial();


  // bearer settings
  gprsSerial.println("AT+SAPBR=3,1,\"CONTYPE\",\"GPRS\"");
  delay(2000);
  toSerial();

  // bearer settings
  gprsSerial.println("AT+SAPBR=3,1,\"APN\",\"airtelgprs.com\"");
  delay(2000);
  toSerial();

  // bearer settings
  gprsSerial.println("AT+SAPBR=1,1");
  delay(2000);
  toSerial();
}


void loop()
{

//voltage sensing
  int sensorValue = analogRead(A0);
  double vold=0,volm=0;// vold=voltage detected; volm=voltage mains
  if(sensorValue!=0){
    vold=sensorValue*0.00500752;
    volm=round((vold+0.594286)/0.016429);
    volm++;
  }// print out the value you read:
  Serial.print("Detected volt:");
  Serial.print(vold);
  Serial.print("  mains voltage:");
  Serial.print(volm);
  Serial.print("  Sensor val:");
  Serial.println(sensorValue);
  //votage sensing end
  //current sensing
  double Irms = emon1.calcIrms(1480);  // Calculate Irms only
  
  Serial.print(Irms*240.0);         // Apparent power
  Serial.print(" ");
  Serial.println(Irms);          // Irms
  //current sensing ends
  //power calculation
  double power=volm*Irms;
  Serial.print("Power:");
  Serial.println(power);
  //power calculation ends
  //GSM sending
   // initialize http service
   gprsSerial.println("AT+HTTPINIT");
   delay(2000); 
   toSerial();

   // set http param value
   String URL="AT+HTTPPARA=\"URL\",\"http://konsole.netau.net/a.php?x=";
   URL.concat(power);
   URL.concat("\"");
   gprsSerial.println(URL);
   delay(2000);
   toSerial();

   // set http action type 0 = GET, 1 = POST, 2 = HEAD
   gprsSerial.println("AT+HTTPACTION=0");
   delay(6000);
   toSerial();

   // read server response
   gprsSerial.println("AT+HTTPREAD"); 
   delay(1000);
   toSerial();

   gprsSerial.println("");
   gprsSerial.println("AT+HTTPTERM");
   toSerial();
   delay(300);

   gprsSerial.println("");
   delay(1024);
   //GSM sending ends
}

void toSerial()
{
  while(gprsSerial.available()!=0)
  {
    Serial.write(gprsSerial.read());
  }
}
