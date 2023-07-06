#include "SPI.h"
#include "Ethernet.h"
byte mac[] = {0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED};
byte server[]={192,168,1,119 };  // IP เครื่องที่จะติดต่อ
byte ip[]={192,168,1,124}; //IP Arduino
EthernetClient client;
String readString;
int RY1 = 8;   //สร้างตัวแปรให้ตรงกับขา Arduino เพื่อง่ายต่อการเขียน
int RY2 = 7;   // 
int RY3 = 6;    //
int RY4 = 5;      //
int SW  = 13;       ///
String T="";
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
   // start the Ethernet connection:
  if (Ethernet.begin(mac) == 0) {
    Serial.println("Failed to configure Ethernet using DHCP");
    // try to congifure using IP address instead of DHCP:
    Ethernet.begin(mac, ip, server);
  }
  // give the Ethernet shield a second to initialize:
  delay(1000);
  Serial.println("connecting...");

  // if you get a connection, report back via serial:
  if (client.connect(server, 80)) {
    Serial.println("connected");
    // Make a HTTP request:
    client.println();
  } else {
    // if you didn't get a connection to the server:
    Serial.println("connection failed");
  }
}

void loop() {
           if (client.available()) {
          char P = client.read();
          Serial.println(P);
         //T += P;
         /*if(T .indexOf("LOCK=1")>0){
          Serial.println();
        digitalWrite(RY1,LOW);
        delay(2000);
        digitalWrite(RY1,HIGH);
        T="";
      }else if (T .indexOf("LOCK=2")>0){
        digitalWrite(RY2,LOW);  
        delay(2000);
        digitalWrite(RY2,HIGH);
        T="";
      }else if (T .indexOf("LOCK=3")>0){
        digitalWrite(RY3,LOW);
        delay(2000);
        digitalWrite(RY3,HIGH);
        T="";
      }else if (T .indexOf("LOCK=4")>0){
        digitalWrite(RY4,LOW);
        delay(2000);
        digitalWrite(RY4,HIGH);
        T="";
      }*/
      client.stop();
      delay(5000);
    }
        }

      
       
        

        /* if (digitalRead(SW)==HIGH){
          client.println("OK");
     if (client.connect(server, 80)) {
      Serial.println("connected");
    // Make a HTTP request:
      client.println("GET /real/test.php?Temp=110 HTTP/1.1");
      client.println("Host: www.google.com");
      client.println("Connection: close");
      client.println("OK");
  } else {
    // if you didn't get a connection to the server:
    Serial.println("Don't GET");
  }
    client.stop();
    delay(5000);
}
}
void SW(EthernetClient c1)
{
   if (client.connect(server, 80)) {
    Serial.println("connected");
    // Make a HTTP request:
    client.println("GET /t/t2.php?Temp=110 HTTP/1.1");  
    client.println("Host: www.google.com");
    client.println("Connection: close");
    client.println();
  } else {
    // if you didn't get a connection to the server:
    Serial.println("connection failed");
  }
    client.stop();
    delay(5000);*/


