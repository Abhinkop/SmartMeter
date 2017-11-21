//#include <SoftwareSerial.h>
//SoftwareSerial gprsSerial(9, 10);
//SIM900 Tx-->Rx Rx-->Tx
char ch,res[200];
int i=0;
String mn="7899194973";
void setup()
{
  Serial.begin(9600);
  //Serial.begin(9600);

  //Serial.println("Config SIM900...");
  delay(2000);
  //Serial.println("Done!...");
  Serial.flush();
  //Serial.flush();

  // attach or detach from GPRS service 
  Serial.println("AT+CGATT?");
  delay(100);
  toSerial();


  // bearer settings
  Serial.println("AT+SAPBR=3,1,\"CONTYPE\",\"GPRS\"");
  delay(2000);
  toSerial();

  // bearer settings
  Serial.println("AT+SAPBR=3,1,\"APN\",\"airtelgprs.com\"");
  delay(2000);
  toSerial();

  // bearer settings
  Serial.println("AT+SAPBR=1,1");
  delay(2000);
  toSerial();
}


void loop()
{
   for(int j=0;j<50;j++)
   {
    int f=savetoserver(mn,j);
    //Serial.println(f);
   }
}

void toSerial()
{
  while(Serial.available()!=0)
  {
    ch=Serial.read();
  }
}
void recSerial()
{
  while(Serial.available()!=0 && i<200)
  {
    res[i++]=Serial.read();
  }
}

int savetoserver(String mno,int power)
{
   // initialize http service
   Serial.println("AT+HTTPINIT");
   delay(2000); 
   toSerial();

   //gprsSerial.flush();
  String URL="AT+HTTPPARA=\"URL\",\"http://konsole.netau.net/ac.php?meterno=";
  URL.concat(mno);
  URL.concat("&reading=");
  URL.concat(power);
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
