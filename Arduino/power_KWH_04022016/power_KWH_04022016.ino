#include "EmonLib.h"                   // Include Emon Library
#include <LiquidCrystal.h>

// initialize the library with the numbers of the interface pins
LiquidCrystal lcd(9, 8, 7,6,5,4);
  
EnergyMonitor emon1;                   // Create an instance
int start;
long long t,cons;
void setup()
{  
  Serial.begin(9600);
  lcd.begin(16, 2);
  emon1.current(A1, 30);             // Current: input pin, calibration.
  start=0;
}

void loop()
{
  lcd.clear();
  lcd.setCursor(0,0);
  double Irms =emon1.calcIrms(1480);
  int asensor=analogRead(A1); 
  //Serial.print(Irms);         // Apparent power
  Serial.print("Current: ");
  Serial.print(Irms);          // Irms
  Serial.print("Amps ");
  int sensorValue = analogRead(A0);
  double vold=0,volm=0;
  if(sensorValue!=0){
    vold=sensorValue*0.00500752;
    volm=round((vold+0.594286)/0.016429);
    volm++;
  }// print out the value you read:
  //Serial.print("Detected volt:");
  //Serial.print(vold);
  Serial.print("  mains voltage:");
  Serial.print(volm);
  //Serial.print("  Sensor val:");
  //Serial.print(sensorValue);
  //Serial.print(" Volts ");
  float power=volm*Irms;
  Serial.print("Power: ");
  Serial.print(power);
  Serial.print(" Watts ");
 
  t=millis()-start;
  start=millis();
  t=t/1000;
  double temp;
  temp=t*power;
  //temp=temp/1000;
  //temp=temp/3600;
  cons=cons+temp;
  Serial.println((int)cons);
  lcd.print("Con          Wat");
  lcd.setCursor(0,1);
  if(cons<1001)
  {
  lcd.print((int)cons);
  lcd.print("Wps  ");
  }
  else if(cons<20001)
  {
  double tem=cons/1000;
  lcd.print(tem);
  lcd.print("KWps    ");
  }
  else
  {
  double tem=cons/1000;
  tem=tem/3600;
  lcd.print(tem);
  lcd.print("KWH     ");
  }
  lcd.print(power);
  delay(1024);
  }
