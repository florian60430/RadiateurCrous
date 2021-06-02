#include <iostream>
#include <unistd.h>
#include <stdio.h>
#include <string.h>
#include <errno.h>
#include <wiringSerial.h>
#include <wiringPi.h>
using namespace std;

int main(int argc, char **argv)
{
  cout<<"Hello World" << endl;

  int fd ;

  if((fd=serialOpen("/dev/serial0",9600))<0){
    
    fprintf(stderr,"Unable to open serial device: %s\n",strerror(errno));
    return 1;
  }
   wiringPiSetup ();


  int nbchar=0;
  for (;;){
    nbchar = 0;
    serialPuts (fd,"V");
     fflush(stdout);
      while(nbchar<20){
        putchar(serialGetchar(fd));  
        fflush(stdout);
        nbchar++;
      }
  
    sleep(1);
   
  
  }

}
