#include <EEPROM.h>
#include "EmonLib.h"
#include <LiquidCrystal.h>

LiquidCrystal lcd(9, 8, 7,6,5,4);
  
EnergyMonitor emon1;
int i=0;
double start,t,cons,lastupdate,lastsave;
char res[200];
void setup()
{  
  lcd.begin(16, 2);
  emon1.current(A1, 30);
  start=0;
  lastupdate=0;
  lastsave=0;
  EEPROM.get(50, cons);
 if(isnan(cons))
 cons=0;
 lcd.print("Connecting!!!");
 lcd.setCursor(0,1);
 lcd.print("Cons=");
 lcd.print(cons);
 delay(15000);
 Serial.begin(9600);
 delay(2000);
 Serial.flush();
 
 Serial.println("AT+CGATT?");
 delay(1000);
 toSerial();
 Serial.println("AT+SAPBR=3,1,\"CONTYPE\",\"GPRS\"");
 delay(2000);
 toSerial();
 Serial.println("AT+SAPBR=3,1,\"APN\",\"airtelgprs.com\"");
 delay(2000);
 toSerial();
 Serial.println("AT+SAPBR=1,1");
 delay(2000);
 toSerial();
 lcd.clear();

}

void loop()
{
  lcd.setCursor(0,0);
  double Irms =emon1.calcIrms(1480);
  int asensor=analogRead(A1); 
  int sensorValue = analogRead(A0);
  double vold=0,volm=0;
  if(sensorValue!=0){
    vold=sensorValue*0.00488758553;
    volm=round((vold+0.594286)/0.016429);
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
  lcd.print("Con|");
  lcd.print(volm);
  lcd.print("|");
  lcd.print(Irms);
    
  lcd.setCursor(0,1);
  lcd.print(cons);
  lcd.print("KWH|");
  lcd.print(power);
  if((millis()-lastupdate)>70000)
  {
    lcd.clear();
    lcd.print("Saving");
    int ret=0;
    while((ret=savetoserver("7899194973",cons))==0){}
    lcd.clear();
    lcd.print("Saved");
    lastupdate=millis();
    delay(1000);
    lcd.clear();
  }
  if((millis()-lastsave)>300000)
  {
    EEPROM.put(50, cons);
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
   Serial.println("AT+HTTPINIT");
   delay(2000); 
   toSerial();

   String URL="AT+HTTPPARA=\"URL\",\"http://konsole.netau.net/ac.php?meterno=";
   URL.concat(mno);
   URL.concat("&reading=");
   URL.concat(powr);
   URL.concat("\"");
   Serial.println(URL);
   delay(2000);
   toSerial();

   Serial.println("AT+HTTPACTION=0");
   delay(6000);
   toSerial();

   Serial.println("AT+HTTPREAD"); 
   delay(1000);
   recSerial();
   Serial.println("");
   Serial.println("AT+HTTPTERM");
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
