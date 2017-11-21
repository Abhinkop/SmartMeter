#include <EEPROM.h>

#include "EmonLib.h"                   // Include Emon Library
#include <LiquidCrystal.h>

// initialize the library with the numbers of the interface pins
LiquidCrystal lcd(9, 8, 7,6,5,4);
  
EnergyMonitor emon1;                   // Create an instance
int i=0;
double start,t,cons,lastupdate,lastsave;
char res[200];
void setup()
{  
  lcd.begin(16, 2);
  emon1.current(A1, 30);             // Current: input pin, calibration.
  start=0;
  lastupdate=0;
  lastsave=0;
  //EEPROM.get(50, cons);
 if(isnan(cons))
 cons=0;
 lcd.print("Connecting!!!");
 lcd.setCursor(0,1);
 lcd.print("Cons=");
 lcd.print(cons);
 //GSM
  lcd.clear();

}

void loop()
{
  //lcd.clear();
  lcd.setCursor(0,0);
  double Irms =emon1.calcIrms(1480);
  int asensor=analogRead(A1); 
  int sensorValue = analogRead(A0);
  double vold=0,volm=0;
  if(sensorValue!=0){
   vold=sensorValue*0.00488758553;
    volm=round((vold+0.594286)/0.016429);
    volm++;
  }
  float power=volm*Irms;
  t=millis()-start;
  start=millis();
  t=t/1000;
  double temp;
  temp=t*power;
  temp=temp/1000;
  temp=temp/3600;
  cons=cons+temp;
  lcd.print(sensorValue);
  lcd.print("|");
  lcd.print(volm);
  lcd.print("|");
  lcd.print(vold);
    
  lcd.setCursor(0,1);
  /*if(cons<1001)
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
  }*/
  lcd.print(cons);
  lcd.print("KWH|");
  lcd.print(power);
  //delay(61440);
  if((millis()-lastupdate)>70000)
  {
    //cons=9999;
    lcd.clear();
    lcd.print("Saving");
    int ret=0;
    while((ret=savetoserver("7899194973",cons))==0)
    {
      
    }
    //lcd.setCursor(8,0);
    lcd.clear();
    lcd.print("Saved");
    lastupdate=millis();
    delay(1000);
    lcd.clear();
  }
  if((millis()-lastsave)>300000)
  {
    //EEPROM.put(50, cons);
    lastsave=millis();
  }
}


  void toSerial()
{
  while(Serial.available()!=0)
  {
    char ch=Serial.read();
  }
}
void recSerial()
{
  while(Serial.available()!=0 && i<200)
  {
    res[i++]=Serial.read();
  }
}

int savetoserver(String mno,double powr)
{
   // initialize http service
   Serial.println("AT+HTTPINIT");
   delay(2000); 
   toSerial();

   //gprsSerial.flush();
  String URL="AT+HTTPPARA=\"URL\",\"http://konsole.netau.net/ac.php?meterno=";
  URL.concat(mno);
  URL.concat("&reading=");
  URL.concat(powr);
  URL.concat("\"");
  //Serial.println(URL);
   // set http param value
   Serial.println(URL);
   delay(2000);
   toSerial();

   // set http action type 0 = GET, 1 = POST, 2 = HEAD
   Serial.println("AT+HTTPACTION=0");
   delay(6000);
   toSerial();

   // read server response
   Serial.println("AT+HTTPREAD"); 
   delay(1000);
   recSerial();
   //gprsSerial.flush();
  

   Serial.println("");
   Serial.println("AT+HTTPTERM");
   //Serial.println("Serial data starts");
   toSerial();
   delay(300);
   Serial.println("");
   if(strstr(res,"recordinserted2414")){
   //Serial.println("record inserted");
   return 1;
   }
   else
   {
    //Serial.println("record not inserted");
   return 0;
   }
   
   delay(10000);
   i=0;
  

}
