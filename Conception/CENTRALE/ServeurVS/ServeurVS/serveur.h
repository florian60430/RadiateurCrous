#pragma once

#include <winsock2.h>
#include <stdio.h>
#pragma comment(lib, "ws2_32.lib")


class serveur
{
private:
	SOCKET servSock;
	SOCKET clientSock;
	int port = 1234;;

public:

	serveur();
	~serveur();
	bool liaison();
	bool listenClient();
	bool sendMessage(char * msg, int length);
	bool recup(char * c, int lenght);
	void close();


};

