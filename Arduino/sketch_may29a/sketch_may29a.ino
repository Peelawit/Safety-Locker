#include <SPI.h>

#include <Ethernet.h>

byte mac[] = {

  0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED

};

IPAddress ip(10,225,131, 19);

IPAddress myDns(192, 168, 1, 1);

EthernetClient client;

 

//char server[] = "arduino.nisit.net";    //กรณีใช้เป็น Domain  จะต้อง ตั้งค่า DNS ที่ myDns ด้วย


IPAddress server(10,255,148,226);     //กรณีใช้เป็น IP

 

unsigned long lastConnectionTime = 0;             // last time you connected to the server, in milliseconds

const unsigned long postingInterval = 10L * 1000L; // delay between updates, in milliseconds

int value;

void setup() {

  Serial.begin(9600);

  while (!Serial) {

    ; 

  }

  delay(1000);

  Ethernet.begin(mac, ip, myDns);

  // print the Ethernet board/shield's IP address:

  Serial.print("My IP address: ");

  Serial.println(Ethernet.localIP());

}

void loop() {

  if (client.available()) {

    //char c = client.find("output=");

    //Serial.write(c);

  }

  if (millis() - lastConnectionTime > postingInterval) {

    httpRequest();

    if(client.find("")){

      client.find("output=");  // ค้นหาคำว่า output= ในเว็บ แล้วดึงค่าตัวแปรออกมาแสดง

      value = client.parseFloat();

      Serial.print("Output = ");

      Serial.println(value); 

    }

  }

}

void httpRequest() {

  client.stop();

  if (client.connect(server, 80)) {

    Serial.println("connecting...");

    // send the HTTP GET request:

    client.println("GET /~a/index.php HTTP/1.1");  // Url ที่ต้องการวิ่งไปอ่านไฟล์

    client.println("Host: www.arduino.cc");

    client.println("User-Agent: arduino-ethernet");

    client.println("Connection: close");

    client.println();

    lastConnectionTime = millis();

  } else {

    Serial.println("connection failed");

  }

}
