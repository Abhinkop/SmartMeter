int i=0,z=0;
double start,t,cons,lastupdate,lastsave,room[7],powr=5.0;
char res[200];



void setup()
{  
 Serial.begin(9600);
 
}

void loop()
{for(z=0;z<7;z++)
 room[z]=-1;
 room[2]=9;
 room[1]=0;
 String URL="AT+HTTPPARA=\"URL\",\"http://konsole.netau.net/update.php?meterno=";
   URL.concat("9738158997");
   URL.concat("&reading=");
   URL.concat(powr);
   for(z=0;z<7;z++)
  {
    if(room[z]!=-1)
    {
    URL.concat("&R");
   URL.concat(z);
   URL.concat("=");
   URL.concat(room[z]);
    }
  }
   URL.concat("\"");
   Serial.println(URL);
   delay(20000);
   
  }


  
   
