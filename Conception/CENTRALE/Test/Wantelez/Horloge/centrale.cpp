#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <ctime>
#include <iostream>
#include <unistd.h>

using namespace std;

int main()
{

while(1)
{
	time_t actuel = time(0);
	tm *ltm = localtime(&actuel);

	int jourActuel = ltm->tm_wday;
	int heureActuel = ltm->tm_hour;
	int minuteActuel = ltm->tm_min;
	int secondeActuel  = ltm->tm_sec;
	std::string jour;

	switch (jourActuel)
	{
	case 1:
		jour = "Lundi";
		break;
	case 2:
		 jour = "Mardi";
		 break;
	case 3:
		jour = "Mercredi";
		break;
	case 4:
		jour = "Jeudi";
		break;
	case 5:
		jour= "Vendredi";
		break;
	case 6:
		jour = "Samedi";
		break;
	case 7:
	    jour = "Dimanche";
		break;
	}
	 cout << jour << " " << heureActuel << "h" << minuteActuel << ":"<< secondeActuel <<endl;
sleep(1);
}

}
