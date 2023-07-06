#include "SPI.h"
#include "Ethernet.h"
byte mac[] = {0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };
IPAddress ip(192,168,1, 124); //192.168.1.140 10,255,131, 19
EthernetServer server(80);
String readString;
int RY1 = 8;
int RY2 = 7;
int RY3 = 6;
int RY4 = 5;
int SW = A0;
int BTN = 0;
String Data="";

void setup() {
  Serial.begin(9600);
  pinMode(RY1, OUTPUT);
  pinMode(RY2, OUTPUT);
  pinMode(RY3, OUTPUT);
  pinMode(RY4, OUTPUT);
  pinMode(SW, INPUT);
  digitalWrite(RY1, HIGH);
  digitalWrite(RY2, HIGH);
  digitalWrite(RY3, HIGH);
  digitalWrite(RY4, HIGH);
  // put your setup code here, to run once:
  Ethernet.begin(mac, ip);
  server.begin();
  Serial.print("Server is at");
  Serial.println(Ethernet.localIP());
  Serial.println("Arduino LOCK Connect");
}

void loop() {

        EthernetClient client = server.available();
        if (client) {
          Serial.println();
        Serial.println("new client");
        boolean currentLineIsBlank = true;
        while (client.connected()) {
        if (client.available()) {
        char P = client.read();
        Serial.write(P);
         Data += P;
         
        if(Data .indexOf("LOCK=1")>0){
        digitalWrite(RY1,LOW);
        delay(2000);
        digitalWrite(RY1,HIGH);
        Data ="";
      }else if (Data  .indexOf("LOCK=2")>0){
        digitalWrite(RY2,LOW);
        delay(2000);
        digitalWrite(RY2,HIGH);
        Data ="";
      }else if (Data  .indexOf("LOCK=3")>0){
        digitalWrite(RY3,LOW);
        delay(2000);
        digitalWrite(RY3,HIGH);
        Data ="";
      }else if (Data  .indexOf("LOCK=4")>0){
        digitalWrite(RY4,LOW);
        delay(2000);
        digitalWrite(RY4,HIGH);
        Data ="";
      }
    }
  }
}
    if(analogRead(SW)==LOW){
  BTN =  analogRead(SW);
  Serial.println(BTN);
  delay (200);
  digitalWrite(RY1,LOW);
  delay (2000);
  digitalWrite(RY1,HIGH);
}
}

