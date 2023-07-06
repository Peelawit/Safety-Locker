#include "SPI.h"
#include "Ethernet.h"
byte mac[] = {0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };
IPAddress ip(192,168,1, 140); //192.168.1.140 10,255,131, 19
EthernetServer server(80);
String readString;
int RY1 = 8;
int RY2 = 7;
int RY3 = 6;
int RY4 = 5;
int SW  = 13;

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
String T="";
void loop() {
        EthernetClient client = server.available();
  if (client) {
    // an http request ends with a blank line
    boolean current_line_is_blank = true;
    while (client.connected()) {
      if (client.available()) {
        char c = client.read();
        // if we've gotten to the end of the line (received a newline
        // character) and the line is blank, the http request has ended,
        // so we can send a reply
        if (c == '\n' && current_line_is_blank) {
          // send a standard http response header
          client.println("HTTP/.1 200 OK");
          client.println("Content-Type: text/html");
          client.println();
          client.println("Arduitronics Test");
          client.println("");
         T += P;
        if(T .indexOf("LOCK=1")>0){
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
      }
    }
  }
}
}
