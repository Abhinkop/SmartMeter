#include <SPI.h>
#include <RF24Network.h>
#include <RF24Network_config.h>
#include <Sync.h>
#include <nRF24L01.h>
#include <RF24.h>
#include <RF24_config.h>
#include <LiquidCrystal.h>

LiquidCrystal lcd(9, 8, 7,6,5,4);
RF24 radio(2,3);
 
// Network uses that radio
RF24Network network(radio);
 
// Address of our node
const uint16_t this_node = 1;
 
// Address of the other node
const uint16_t other_node = 0;
 
// How often to send 'hello world to the other unit
const unsigned long interval = 2000; //ms
 
// When did we last send?
unsigned long last_sent;
 
// How many have we sent already
unsigned long packets_sent;
 
// Structure of our payload
struct payload_t
{
  float kwh;
  int rno;
};
void setup() {
  // put your setup code here, to run once:
  Serial.begin(9600);
  SPI.begin();
  radio.begin();
  network.begin(/*channel*/ 90, /*node address*/ other_node);
}

void loop(void)
{
  // Pump the network regularly
  network.update();
// Serial.print("update ");
    
  // Is there anything ready for us?
  while ( network.available() )
  {
    // If so, grab it and print it out
    RF24NetworkHeader header;
    payload_t payload;
    network.read(header,&payload,sizeof(payload));
    Serial.print("Consumption ");
    Serial.print(payload.kwh);
    Serial.print(" at ");
    Serial.println(payload.rno);
  }
}
