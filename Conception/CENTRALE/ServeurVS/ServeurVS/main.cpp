// ServeurVS.cpp : Ce fichier contient la fonction 'main'. L'exécution du programme commence et se termine à cet endroit.
//
#pragma hdrstop
#include <stdio.h>
#include <iostream>
#include <stdlib.h>
#include <string.h>
#include "serveur.h"
#include <winsock.h>


using namespace std;

int main()
{	
	char trame[9];
	char data[100] = "";
	char reponse[5] = { 'M','E','R','C', 'I' };
	char message, finDeChaine;

	do {
		
		serveur myServeur;
		if (myServeur.liaison() == false)

		{
			cout << "erreur lors de la liaison" << endl;
		}
		else
		{
			cout << "la liaison c'est bien etablie" << endl;
		}


		if (myServeur.listenClient() == false)
		{
			cout << "erreur lors du listen" << endl;
		}
		else
		{
			cout << "le listen c'est bien etablie" << endl;
		}




		if (myServeur.recup(data, 5) == true)
			{
				message = data[0];
				finDeChaine = data[1];
				cout << "le message envoye est : " << data << endl;
				myServeur.sendMessage(reponse, 5);
			}

		else if (message == ';')
			{
				cout << "fermeture de la liaison" << endl;
				myServeur.sendMessage(reponse, 5);
				myServeur.close();
			}
			
		else
			{
				cout << "La commande envoye n existe pas" << endl;
			}

		myServeur.close();
		cout << "fermeture de la liaison" << endl;
		
	
	} while (message != ';');


	return 0;
}



// Exécuter le programme : Ctrl+F5 ou menu Déboguer > Exécuter sans débogage
// Déboguer le programme : F5 ou menu Déboguer > Démarrer le débogage

// Astuces pour bien démarrer : 
//   1. Utilisez la fenêtre Explorateur de solutions pour ajouter des fichiers et les gérer.
//   2. Utilisez la fenêtre Team Explorer pour vous connecter au contrôle de code source.
//   3. Utilisez la fenêtre Sortie pour voir la sortie de la génération et d'autres messages.
//   4. Utilisez la fenêtre Liste d'erreurs pour voir les erreurs.
//   5. Accédez à Projet > Ajouter un nouvel élément pour créer des fichiers de code, ou à Projet > Ajouter un élément existant pour ajouter des fichiers de code existants au projet.
//   6. Pour rouvrir ce projet plus tard, accédez à Fichier > Ouvrir > Projet et sélectionnez le fichier .sln.
