#include <SoftwareSerial.h>
SoftwareSerial gprsSerial(10, 11);
//SIM900 Tx-->7 Rx-->8
char ch,res[200],mno[10]="7899194973";
int i=0;
void setup()
{
  gprsSerial.begin(9600);
  Serial.begin(9600);

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


void loop()
{
   for(int j=0;j<50;j++)
   {
    int f=savetoserver(mno,j);
    Serial.println(f);
   }
}

void toSerial()
{
  while(gprsSerial.available()!=0)
  {
    Serial.write(gprsSerial.read());
  }
  //Serial.println();
}
void recSerial()
{
  while(gprsSerial.available()!=0 && i<200)
  {
    res[i++]=gprsSerial.read();
  }
  //Serial.println(res);
}

int savetoserver(String mno,int powr)
{
   // initialize http service
   gprsSerial.println("AT+HTTPINIT");
   delay(2000); 
   toSerial();

   //gprsSerial.flush();
String URL="AT+HTTPPARA=\"URL\",\"http://konsole.netau.net/ac.php?meterno=";
  URL.concat(mno);
  URL.concat("&reading=");
  URL.concat(powr);
  URL.concat("\"");
   // set http param value
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
   delay(1000);
   toSerial();
   //gprsSerial.flush();
  

   gprsSerial.println("");
   gprsSerial.println("AT+HTTPTERM");
   //Serial.println("Serial data starts");
   toSerial();
   delay(300);
   gprsSerial.println("");
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

