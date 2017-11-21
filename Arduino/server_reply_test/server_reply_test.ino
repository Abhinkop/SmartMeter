char * a="recordinserted2414\nreset2414\ncostchanged2414\n!!!5!!!";
char c[7];
void setup() {
  // put your setup code here, to run once:
Serial.begin(9600);
}

void loop() {
  // put your main code here, to run repeatedly:

//Serial.println(a);

delay(20000);
}
int checkcostchange()
{
if(strstr(a,"costchanged2414"))
{
char *x=strstr(a,"!!!");
int i=0;
while(x[i]=='!')
i++;
int j=0;
while(x[i]!='!')
{
  c[j]=x[i];
  i++;
  j++;
}
//Serial.println(x);
//Serial.println(c);
String aa=String(c);
float p=aa.toFloat();
Serial.println(p);
} 
}
void reset()
{
  if(strstr(a,"reset2414"))
{
  Serial.println("reset");
}

}

