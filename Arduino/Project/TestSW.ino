#include "SPI.h"
#include "Ethernet.h"
byte mac[] = {0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };
IPAddress server(74,125,232,128);
IPAddress ip(10,225,131, 19); //192.168.1.140 10,255,131, 19
IPAddress gateway(10, 225, 131, 254);
IPAddress subnet(255, 255, 254, 0);
EthernetClient client;
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
  //pinMode(SW, INPUT);
  digitalWrite(RY1, HIGH);
  digitalWrite(RY2, HIGH);
  digitalWrite(RY3, HIGH);
  digitalWrite(RY4, HIGH);
  digitalWrite(RY5, HIGH);
  digitalWrite(RY6, HIGH);
  digitalWrite(RY8, HIGH);
  // put your setup code here, to run once:
   if (Ethernet.begin(mac) == 0) {
    Serial.println("Failed to configure Ethernet using DHCP");
    // try to congifure using IP address instead of DHCP:
    Ethernet.begin(mac, ip, gateway, subnet);
  }
  // give the Ethernet shield a second to initialize:
  delay(1000);
  Serial.println("connecting...");

  // if you get a connection, report back via serial:
  if (client.connect(server, 80)) {
    Serial.println("connected");
    // Make a HTTP request:
    client.println("GET /search?q=arduino HTTP/1.1");
    client.println("Host: www.google.com");
    client.println("Connection: close");
    client.println();
  } else {
    // if you didn't get a connection to the server:
    Serial.println("connection failed");
  }
}

void loop() {

       
        
        if (client.available()) {
        char P = client.read();
        Serial.write(P);
         Data += P;
         
        if(Data .indexOf("LOCK=AAA")>0){
        digitalWrite(RY1,LOW);
        delay(2000);
        digitalWrite(RY1,HIGH);
        Data ="";
      }else if (Data  .indexOf("LOCK=BBB")>0){
        digitalWrite(RY2,LOW);
        delay(2000);
        digitalWrite(RY2,HIGH);
        Data ="";
      }else if (Data  .indexOf("LOCK=CCC")>0){
        digitalWrite(RY3,LOW);
        delay(2000);
        digitalWrite(RY3,HIGH);
        Data ="";
      }else if (Data  .indexOf("LOCK=DDD")>0){
        digitalWrite(RY4,LOW);
        delay(2000);
        digitalWrite(RY4,HIGH);
        Data ="";
      }else if (Data  .indexOf("LOCK=EEE")>0){
        digitalWrite(RY5,LOW);
        delay(2000);
        digitalWrite(RY5,HIGH);
        Data ="";
      }else if (Data  .indexOf("LOCK=FFF")>0){
        digitalWrite(RY6,LOW);
        delay(2000);
        digitalWrite(RY6,HIGH);
        Data ="";
      }
    }
  }
    /*if(digitalRead(SW)==LOW){
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
}*/


