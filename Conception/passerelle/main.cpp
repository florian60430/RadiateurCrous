#include <iostream>
#include <unistd.h>
#include <stdio.h>
#include <string.h>
#include <mosquitto.h>
#include <iostream>
#include "mqtt.h"
#include "serie.h"

using namespace std;

int main(int argc, char **argv)
{
  int rc;
  char buffer[100];

  mosquitto_lib_init();
  mqtt mosquitto(NULL, true, NULL);
  mosquitto.callbackConnexion();
  mosquitto.callbackMessage();
  rc = mosquitto.connexion("192.168.65.250", 1883, 10);
  if (rc)
  {
    cout << "Impossible de se connecter au broker " << rc << endl;
  }

  mosquitto.loopStart();

  for (;;)
  {
    serie::get()->recevoir(buffer);
    mosquitto.publier(NULL, 0, false, "temperature", buffer);
  }

  mosquitto.loopStop(true);

  return 0;
}