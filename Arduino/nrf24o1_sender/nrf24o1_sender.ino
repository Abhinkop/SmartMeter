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
  unsigned long ms;
  unsigned long counter;
};
void setup() {
  // put your setup code here, to run once:
  lcd.begin(16, 2);
  SPI.begin();
  radio.begin();
  network.begin(/*channel*/ 90, /*node address*/ this_node);
}

void loop(void)
{
  // Pump the network regularly
  network.update();
 
  // If it's time to send a message, send it!
  unsigned long now = millis();
  if ( now - last_sent >= interval  )
  {
    last_sent = now;
 
    lcd.print("Sending...");
    payload_t payload = { millis(), packets_sent++ };
    RF24NetworkHeader header(/*to node*/ other_node);
    bool ok = network.write(header,&payload,sizeof(payload));
    lcd.clear();
    if (ok)
      lcd.println("ok.");
    else
      lcd.println("failed.");
  }
  lcd.clear();
}

