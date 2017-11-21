#include <EEPROM.h>
#include "EmonLib.h"
#include <LiquidCrystal.h>
#include <SPI.h>
#include <RF24Network.h>
#include <RF24Network_config.h>
#include <Sync.h>
#include <nRF24L01.h>
#include <RF24.h>
#include <RF24_config.h>

LiquidCrystal lcd(9, 8, 7,6,5,4);
  
EnergyMonitor emon1;
int i=0;   
double start,t,cons,lastupdate,lastsave;
char res[200];

RF24 radio(2,3);
 
// Network uses that radio
RF24Network network(radio);
 
// Address of our node
const uint16_t this_node = 1;
 
// Address of the other node
const uint16_t other_node = 0;
 
 
// Structure of our payload
struct payload_t
{
  float kwh;
  int rno;
};

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
  SPI.begin();
  radio.begin();
  network.begin(/*channel*/ 90, /*node address*/ this_node);

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
  lcd.print(vold);
  lcd.print("|");
  lcd.print(Irms);
    
  lcd.setCursor(0,1);
  lcd.print(cons);
  lcd.print("KWH|");
  lcd.print(power);
  if((millis()-lastsave)>300000)
  {
    EEPROM.put(50, cons);
    lastsave=millis();
  }
  network.update();
  //lcd.clear();
  lcd.print("Sending...");
  payload_t payload = { cons, this_node };
  RF24NetworkHeader header(/*to node*/ other_node);
  bool ok = network.write(header,&payload,sizeof(payload));
  //lcd.clear();
    
}


  
