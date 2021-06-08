const int ARRET = 13;

void setup() {
  Serial.begin(9600);
  pinMode(ARRET, OUTPUT);
}

void loop() {
  digitalWrite(ARRET, LOW);
  delay(3000);
  digitalWrite(ARRET, HIGH);
  delay(3000);

}
