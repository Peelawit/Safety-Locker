#include "SPI.h"

#include "Ethernet.h"

byte mac[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED }; //physical mac address
IPAddress ip(10,225,131, 19); //10.225.131.19/
EthernetServer server(80); //server port

String readString; 

//////////////////////

int RY1 = 8;
int RY2 = 7;
int RY3 = 6;
int RY4 = 5;

void setup(){

 Serial.begin(9600);

 pinMode(RY1, OUTPUT); //pin selected to control
 pinMode(RY2, OUTPUT);
 pinMode(RY3, OUTPUT);
 pinMode(RY4, OUTPUT);

 
 digitalWrite(RY1, HIGH);
digitalWrite(RY2, HIGH);
digitalWrite(RY3, HIGH);
digitalWrite(RY4, HIGH);
 //start Ethernet

Ethernet.begin(mac, ip);
server.begin();
Serial.print("server is at ");
Serial.println(Ethernet.localIP());

 Serial.println("ArduinoAll server LOCK test"); // so I can keep track of what is loaded

}

String w = "";
void loop()
{
     /* if(mySerial.available()>0)
      {
         x = mySerial.read(); 
      }*/
      EthernetClient client = server.available();
  if (client) {
  Serial.println("new client");
  boolean currentLineIsBlank = true;
  while (client.connected()) {
  if (client.available()) {
  char q = client.read();
  Serial.write(q);
  w += q;
   if(w .indexOf("name=1") >0)//checks for on
          {
            digitalWrite(RY1,LOW);
            delay(2000);
            digitalWrite(RY1,HIGH);
            w ="";
          }else if(w .indexOf("name=2") >0)//checks for on
          {
            digitalWrite(RY2,LOW);
            delay(2000);
            digitalWrite(RY2,HIGH);
            w ="";
          }else if(w .indexOf("name=3") >0)//checks for on
          {
            digitalWrite(RY3,LOW);
            delay(2000);
            digitalWrite(RY3,HIGH);
            w ="";
          }else if(w .indexOf("name=4") >0)//checks for on
          {
            digitalWrite(RY4,LOW);
            delay(2000);
            digitalWrite(RY4,HIGH);
            w ="";
          }
   }
}
          

          ///////////////
 
}
}


