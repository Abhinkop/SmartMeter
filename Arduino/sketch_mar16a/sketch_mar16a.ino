#include <SoftwareSerial.h>

SoftwareSerial mySerial(10, 11); // RX, TX

void setup()
{
// Open serial communications and wait for port to open:
Serial.begin(19200);

Serial.println("Calling through GSM Modem");

// set the data rate for the SoftwareSerial port
mySerial.begin(19200);
delay(2000);
mySerial.println("ATD9738158997;"); // ATD81290255XX; -- watch out here for semicolon at the end!!

Serial.println("Called ATD81290255XX");
}

void loop() // run over and over
{
// print response over serial port
if (mySerial.available())
Serial.write(mySerial.read());
}
