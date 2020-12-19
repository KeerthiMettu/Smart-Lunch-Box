#include <SoftwareSerial.h>
#include <ArduinoJson.h>
#include "HX711.h"  //You must have this library in your arduino library folder

#define DOUT  A0
#define CLOCK  A1

#define DOUT2  A2        //  Load Cell B pin connections
#define CLK2  A3

SoftwareSerial s(5, 6);

HX711 scale;
HX711 scale1;

float calibration_factor = -160.20; //-106600 worked for my 40Kg max scale setup
float calibration_factor1 = -58.11;
//float weight_1 = 0.0;             //  weight of car from scale A
//float weight_2 = 0.0;
//float total_food_weight;


void setup() {

  s.begin(9600);
 // Serial.println("Press T to tare");
  scale.begin(DOUT, CLOCK);
  scale1.begin(DOUT2,CLK2);
  scale.set_scale(-160.20);  //Calibration Factor obtained from first sketch
   scale1.set_scale(-58.11);
  scale.tare();             //Reset the scale to 0
  scale1.tare();

}


StaticJsonBuffer<1000> jsonBuffer;
JsonObject& root = jsonBuffer.createObject();


void loop() {

  Serial.print("Weight: ");
  int weight1 = scale.get_units();
   int weight2 = scale1.get_units();
  //Serial.print(weight, 3);  //Up to 3 decimal points
  //Serial.println(" grams"); //Change this to kg and re-adjust the calibration factor if you follow lbs
  delay(2000);
  Serial.println(weight1);
//  if (Serial.available())
//  {
//    char temp = s.read();
//    if (temp == 't' || temp == 'T')
//      scale.tare();  //Reset the scale to zero
//  }
  root["data1"] = 900;
  root["data2"] = 200;
  root["Foodweight1"] = weight1;
  root["Foodweight2"] = weight2;
  if (s.available() > 0)
  {
    root.printTo(s);
  }

}
