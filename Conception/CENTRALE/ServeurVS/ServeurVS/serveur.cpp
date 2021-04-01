#include "serveur.h"
#include <iostream>

using namespace std;

serveur::serveur() {

	WSADATA wsa;
	WSAStartup(MAKEWORD(2, 2), &wsa);

	servSock = socket(AF_INET, SOCK_STREAM, 0);    // creation du socket
	if (servSock == INVALID_SOCKET)

	{
		cout << "Erreur lors de la creation du socket" << endl;
	}
}

serveur::~serveur()
{
	
}

bool serveur::liaison() {

	WSADATA wsa;
	WSAStartup(MAKEWORD(2, 2), &wsa);

	SOCKADDR_IN sin = { 0 };
	sin.sin_addr.s_addr = htonl(INADDR_ANY); /* nous sommes un serveur, nous acceptons n'importe quelle adresse */
	sin.sin_family = AF_INET;
	sin.sin_port = htons(port);
	if (bind(servSock, (SOCKADDR *)&sin, sizeof sin) == SOCKET_ERROR)
	{
		return false;
	}
	else
	{
		return true;
	}
}

bool serveur::listenClient()
{

	WSADATA wsa;
	WSAStartup(MAKEWORD(2, 2), &wsa);

	if (listen(servSock, 5)== SOCKET_ERROR)
	{
		return false;
	}
	else 
	{
		SOCKADDR_IN csin = { 0 };

		int sinsize = sizeof csin;

		clientSock = accept(servSock, (SOCKADDR *)&csin, &sinsize);

		if (clientSock == INVALID_SOCKET)
		{
			return false;
		}
		else 
		{
			return true;
		}
	}
}

bool serveur::sendMessage(char * msg, int length)
{

	WSADATA wsa;
	WSAStartup(MAKEWORD(2, 2), &wsa);
	bool resultSend;

	resultSend = send(clientSock, msg, length, 0);

	if (resultSend == -1)
	{
		return false;
	}
	else 
	{
		return true;
	}

}

bool serveur::recup(char * c, int length)
{
	int n;

	n = recv(clientSock, c, length, 0);

	if (n == SOCKET_ERROR)
	{
		return false;
	}
	else
	{
		return true;
	}

}

void serveur::close()
{
	closesocket(servSock);
	closesocket(clientSock);
}
