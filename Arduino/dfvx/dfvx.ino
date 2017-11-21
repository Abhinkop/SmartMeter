void setup() {
  // put your setup code here, to run once:
Serial.begin(9600);

Serial.println("AT+HTTPPARA=\"URL\",\"http://konsole.netau.net/ac.php?meterno=7899194973&reading=3\"");
}

void loop() {
  // put your main code here, to run repeatedly:
  int power=3,x=0;
  String mno="7899194973";
  String URL="AT+HTTPPARA=\"URL\",\"http://konsole.netau.net/ac.php?meterno=";
  URL.concat(mno);
  URL.concat("&reading=");
  URL.concat(power);
  URL.concat("\"");
  Serial.println(URL);
  URL="AT+HTTPPARA=\"URL\",\"http://konsole.netau.net/a.php?x=";
  URL.concat(x);
  URL.concat("\"");
  Serial.println(URL);
  delay(10000000);
}
