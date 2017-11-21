#include "EmonLib.h"                   // Include Emon Library
#include <LiquidCrystal.h>

// initialize the library with the numbers of the interface pins
LiquidCrystal lcd(9, 8, 7,6,5,4);
  
EnergyMonitor emon1;                   // Create an instance
int start;

void setup()
{  
  Serial.begin(9600);
  lcd.begin(16, 2);
  emon1.current(A1, 30);             // Current: input pin, calibration.
}

void loop()
{
  double Irms =emon1.calcIrms(1480);
  int asensor=analogRead(A1); 
  //Serial.print(Irms*240.0);         // Apparent power
  //Serial.print("Current: ");
  Serial.println(asensor);          // Irms
  //Serial.print("Amps ");
  int sensorValue = analogRead(A0);
  double vold=0,volm=0;
  if(sensorValue!=0){
    vold=sensorValue*0.00500752;
    volm=round((vold+0.594286)/0.016429);
    volm++;
  }// print out the value you read:
  //Serial.print("Detected volt:");
  //Serial.print(vold);
  //Serial.print("  mains voltage:");
  //Serial.print(volm);
  //Serial.print("  Sensor val:");
  //Serial.print(sensorValue);
  //Serial.print(" Volts ");
  float power=volm*Irms;
  //Serial.print("Power: ");
  //Serial.print(power);
  //Serial.println(" Watts ");
  lcd.print("Volt    Amp  Wat");
  lcd.setCursor(0,1);
  lcd.print(volm);
  lcd.print("  ");
  lcd.print(Irms);
  lcd.print(" ");
  lcd.print(power);
  }
