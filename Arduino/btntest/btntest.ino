#include "SPI.h"

#include "Ethernet.h"

byte mac[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED }; //physical mac address

EthernetServer server(80); //server port

String readString; 

//////////////////////

int LED1 = 8;
int LED2 = 7;
int LED3 = 6;
int LED4 = 5;
int val_LED1 = 0 ;
int val_LED2 = 0 ;
int val_LED3 = 0 ;
int val_LED4 = 0 ;
 
void setup(){

 Serial.begin(9600);

 pinMode(LED1, OUTPUT); //pin selected to control
 pinMode(LED2, OUTPUT);
 pinMode(LED3, OUTPUT);
 pinMode(LED4, OUTPUT);

 
 digitalWrite(LED1, LOW);
digitalWrite(LED2, LOW);
digitalWrite(LED3, LOW);
digitalWrite(LED4, LOW);
 //start Ethernet

 Ethernet.begin(mac);

 Serial.println("ArduinoAll server LOCK test"); // so I can keep track of what is loaded

}

void loop(){

 EthernetClient client = server.available();
 if (client) {
  Serial.println("new client");
  boolean currentLineIsBlank = true;
  while (client.connected()) {
  if (client.available()) {
  char q = client.read();
  Serial.write(q);
      switch(q)
      {
        case 'Z':
        digitalWrite(LED1,LOW);
        
        break;
        
        case 'z':
        digitalWrite(LED2,LOW);
        delay(1000);
        digitalWrite(LED2,HIGH);
        break;
        if (q=='Z'){
          digitalWrite(LED1,LOW);
          delay(2000);
          digitalWrite(LED1,HIGH);
      }else if(q=='X'){
        digitalWrite(LED2,LOW);
        delay(2000);
        digitalWrite(LED2,HIGH);
      }
   }
}

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

          client.println("<head>");

          client.println("<title>Myarduino Control LED</title>");

          client.println("</head>");
          
          client.println("<body>");
          client.println("<center>");
          client.println("<h1>TEST LOCK 8</h1>");

          // DIY buttons

          client.println("Status LOCK is :  "); 

          StateLOCK(client);

          Changetext(client);

          client.println("<br><input type=button value=ON onmousedown= location.href='/on1'>");

          client.println(" "); 

          client.println("<input type=button value=OFF onmousedown= location.href='/off1'><br>");
          /////////////////////////////////////////////////////////////////////////////////
          client.println("Ry 2<br>"); 
          client.println("Status LOCK is :  "); 
          //StateLOCK2(client);
          //Changetext2(client);
          client.println("<br><input type=button value=ON onmousedown= location.href='/on2'>");
          client.println(" "); 
          client.println("<input type=button value=OFF onmousedown= location.href='/off2'><br>");
          /////////////////////////////////////////////////////////////////////////////////
                    client.println("Ry 3<br>"); 
                    client.println("Status LOCK is :  "); 
          //StateLOCK3(client);
          //Changetext3(client);
          client.println("<br><input type=button value=ON onmousedown= location.href='/on3'>");
          client.println(" "); 
          client.println("<input type=button value=OFF onmousedown= location.href='/off3'><br>");
          /////////////////////////////////////////////////////////////////////////////////
             client.println("Ry 4<br>"); 
             client.println("Status LOCK is :  "); 
          //StateLOCK4(client);
          //Changetext4(client);
          client.println("<br><input type=button value=ON onmousedown= location.href='/on4'>");
          client.println(" "); 
          client.println("<input type=button value=OFF onmousedown= location.href='/off4'><br>");
          /////////////////////////////////////////////////////////////////////////////////
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

  }

}
}
}

void StateLOCK(EthernetClient cl)

{

          if(readString.indexOf("on1") >0)//checks for on

          {

            digitalWrite(LED1, LOW); 
            Serial.println("Led On");   
            //delay(4000);
            //digitalWrite(LED1, HIGH);
            

          }

         if(readString.indexOf("off1") >0)//checks for off

          {

            digitalWrite(LED1, HIGH);    

            Serial.println("Led Off");

          } 

}
void StateLOCK2(EthernetClient cl)

{

          if(readString.indexOf("on2") >0)//checks for on

          {

            digitalWrite(LED2, LOW); 
            Serial.println("Led On");   
            //delay(4000);
            //digitalWrite(LED1, HIGH);
            

          }

         if(readString.indexOf("off2") >0)//checks for off

          {

            digitalWrite(LED2, HIGH);    

            Serial.println("Led Off");

          } 

}void StateLOCK3(EthernetClient cl)

{

          if(readString.indexOf("on3") >0)//checks for on

          {

            digitalWrite(LED3, LOW); 
            Serial.println("Led On");   
            //delay(4000);
            //digitalWrite(LED3, HIGH);
            

          }

         if(readString.indexOf("off3") >0)//checks for off

          {

            digitalWrite(LED3, HIGH);    

            Serial.println("Led Off");

          } 

}void StateLOCK4(EthernetClient cl)

{

          if(readString.indexOf("on4") >0)//checks for on

          {

            digitalWrite(LED4, LOW); 
            Serial.println("Led On");   
            //delay(4000);
            //digitalWrite(LED1, HIGH);
            

          }

         if(readString.indexOf("off4") >0)//checks for off

          {

            digitalWrite(LED4, HIGH);    

            Serial.println("Led Off");

          } 

}
void Changetext(EthernetClient cl){

    val_LED1 = digitalRead(LED1);

    Serial.println(val_LED1);

    if(val_LED1 == HIGH){

        cl.println("OFF");

    }

    else { //if(val_LED1 == LOW)

        cl.println("ON");

    }  

}
void Changetext2(EthernetClient cl){

    val_LED2 = digitalRead(LED2);

    Serial.println(val_LED2);

    if(val_LED2 == HIGH){

        cl.println("OFF");

    }

    else { //if(val_LED1 == LOW)

        cl.println("ON");

    }  

}void Changetext3(EthernetClient cl){

    val_LED3 = digitalRead(LED3);

    Serial.println(val_LED3);

    if(val_LED3 == HIGH){

        cl.println("OFF");

    }

    else { 

        cl.println("ON");

    }  

}void Changetext4(EthernetClient cl){

    val_LED4 = digitalRead(LED4);

    Serial.println(val_LED4);

    if(val_LED4 == HIGH){

        cl.println("OFF");

    }

    else { //if(val_LED1 == LOW)

        cl.println("ON");

    }  

}

 
