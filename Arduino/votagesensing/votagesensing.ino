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
  double vold=0,volm=0;
  if(sensorValue!=0){
    vold=sensorValue*0.00500752;
    volm=round((vold+0.594286)/0.016429);
    volm++;
  }// print out the value you read:
  Serial.print("Detected volt:");
  Serial.print(vold);
  Serial.print("  mains voltage:");
  Serial.print(volm);
  Serial.print("  Sensor val:");
  Serial.println(sensorValue);
  delay(1024);        // delay in between reads for stability
}
