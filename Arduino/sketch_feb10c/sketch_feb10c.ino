float sample1=0; // for voltage
float sample2=0; // for current
float voltage=0.0;
float val; // current callibration
float actualval; // read the actual current from ACS 712
float amps=0.0;
float totamps=0.0; 
float avgamps=0.0;
float amphr=0.0;
float watt=0.0;
float energy=0.0; 

void setup()
{
 // Open serial communications and wait for port to open:
  Serial.begin(9600);
  

  
}

void loop()

{
   
 sample2=analogRead(A1); //read the current from sensor
   
 Serial.println(sample2);
  //delay(500);
}





