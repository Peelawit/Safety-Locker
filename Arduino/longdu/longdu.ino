#include "SPI.h"

#include "Ethernet.h"

byte mac[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED }; //physical mac address
IPAddress ip(10,225,131, 19); //10.225.131.19/
EthernetServer server(80); //server port

String readString; 

//////////////////////

int LED1 = 8;
int LED2 = 7;
int LED3 = 6;
int LED4 = 5;

void setup(){

 Serial.begin(9600);

 pinMode(LED1, OUTPUT); //pin selected to control
 pinMode(LED2, OUTPUT);
 pinMode(LED3, OUTPUT);
 pinMode(LED4, OUTPUT);

 
 digitalWrite(LED1, HIGH);
digitalWrite(LED2, HIGH);
digitalWrite(LED3, HIGH);
digitalWrite(LED4, HIGH);
 //start Ethernet

Ethernet.begin(mac, ip);
server.begin();
Serial.print("server is at ");
Serial.println(Ethernet.localIP());

 Serial.println("ArduinoAll server LOCK test"); // so I can keep track of what is loaded

}
char x;
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
   if(readString.indexOf("name=1") >0)//checks for on
          {
            digitalWrite(LED1,LOW);
            delay(2000);
            digitalWrite(LED1,HIGH);
            
          }
   }
}
          

          ///////////////
 EthernetClient client = server.available();

  if (client) {

    while (client.connected()) {

      if (client.available()) {

        char c = client.read();

        //read char by char HTTP request

        if (readString.length() < 100) {

          //store characters to string 

          readString += c; 

          //Serial.print(c);

        } 

        //if HTTP request has ended

        if (c == '\n') {

          ///////////////

          Serial.println(readString); //print to serial monitor for debuging 

          client.println("HTTP/1.1 200 OK"); //send new page

          client.println("Content-Type: text/html");
          
          client.println();

          client.println("<html>");
          client.println("<meta http-equiv= 'refresh' content='0; url=file:///D:/WEB/p.php'/>");
          client.println("<head>");

          client.println("<title>Myarduino Control LED</title>");

          client.println("</head>");
          
          client.println("<body>");
          client.println("<center>");
          client.println("<h1>TEST LOCK 8</h1>");

          // DIY buttons
        
          client.println("Status LOCK is :  "); 

          

          client.println("<br><input type=button value=ON onmousedown= location.href='/on1'>");

          client.println(" "); 

          client.println("<input type=button value=OFF onmousedown= location.href='/off1'><br>");
          
          client.println("</body>");

          client.println("</html>");

          delay(1);

          //stopping client

          client.stop();

          ///////////////////// control arduino pin

          readString="";

        }
  }
}
  }         //checks for on         
}

}
  void RY(EthernetClient cl)

{
          if(readString.indexOf("name=1") >0)//checks for on
          {
            digitalWrite(LED1,LOW);
            delay(2000);
            digitalWrite(LED1,HIGH);
            
          }
          if(readString.indexOf("name=2") >0)//checks for on
          {
            digitalWrite(LED2,LOW);
            delay(2000);
            digitalWrite(LED2,HIGH);
            
          }
}
