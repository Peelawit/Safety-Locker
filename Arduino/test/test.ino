#include "SPI.h"
#include "Ethernet.h"
byte mac[] = {0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };
IPAddress ip(10,225,131, 19); //192.168.1.140 10,255,131, 19
IPAddress gateway(10, 225, 131, 254);
IPAddress subnet(255, 255, 254, 0);
EthernetServer server(80);
String readString;
int RY1 = 3;
int RY2 = 5;
int RY3 = 6;
int RY4 = 7;
int RY5 = 8;
int RY6 = 9;
int RY8 = 13;
int SW = 2;
int BTN = 0;
String Data="";

void setup() {
  Serial.begin(9600);
  pinMode(RY1, OUTPUT);
  pinMode(RY2, OUTPUT);
  pinMode(RY3, OUTPUT);
  pinMode(RY4, OUTPUT);
  pinMode(RY5, OUTPUT);
  pinMode(RY6, OUTPUT);
  pinMode(RY8, OUTPUT);
  pinMode(SW, INPUT);
  digitalWrite(RY1, HIGH);
  digitalWrite(RY2, HIGH);
  digitalWrite(RY3, HIGH);
  digitalWrite(RY4, HIGH);
  digitalWrite(RY5, HIGH);
  digitalWrite(RY6, HIGH);
  digitalWrite(RY8, HIGH);
  // put your setup code here, to run once:
  Ethernet.begin(mac, ip, gateway, subnet);
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
         
        
    }
  }
}
    if(digitalRead(SW)==LOW){
  BTN =  digitalRead(SW);
  Serial.println(BTN);
  delay (200);
  digitalWrite(RY1,LOW);
  delay (2000);
  digitalWrite(RY1,HIGH);
  delay (1000);
  digitalWrite(RY2,LOW);
  delay (2000);
  digitalWrite(RY2,HIGH);
  delay (1000);
  digitalWrite(RY3,LOW);
  delay (2000);
  digitalWrite(RY3,HIGH);
  delay (1000);
  digitalWrite(RY4,LOW);
  delay (2000);
  digitalWrite(RY4,HIGH);
  delay (1000);
  digitalWrite(RY5,LOW);
  delay (2000);
  digitalWrite(RY5,HIGH);
  delay (1000);
  digitalWrite(RY6,LOW);
  delay (2000);
  digitalWrite(RY6,HIGH);
}
}

