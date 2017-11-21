/*
  AnalogReadSerial
  Reads an analog input on pin 0, prints the result to the serial monitor.
  Graphical representation is available using serial plotter (Tools > Serial Plotter menu)
  Attach the center pin of a potentiometer to pin A0, and the outside pins to +5V and ground.

  This example code is in the public domain.
*/

// the setup routine runs once when you press reset:
void setup() {
  // initialize serial communication at 9600 bits per second:
  Serial.begin(9600);
}

// the loop routine runs over and over again forever:
void loop() {
  // read the input on analog pin 0:
  int sensorValue = analogRead(A0);
  double vold=0,curm=0,Iss=0,Irms=0;
  if(sensorValue>516){
  for (int i=0;i<1480;i++)
  {
    sensorValue = analogRead(A0); 
    vold=double((double(sensorValue)*5)/1024);
    vold=vold-2.51;
    curm=vold*30.00;
    Iss=Iss+(curm*curm);
    delay(2);
    //volm=round((vold+0.594286)/0.016429);
  }// print out the value you read:
  Irms=sqrt(Iss/1480);
  }
  Serial.print("Detected volt:");
  Serial.print(vold);
  Serial.print("  mains Current:");
  Serial.print(Irms);
  Serial.print("  Sensor val:");
  Serial.println(sensorValue);
  //delay(1024);        // delay in between reads for stability
}
