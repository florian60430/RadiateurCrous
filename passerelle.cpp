#include "passerelle.h"
#include <mysql.h>

bool passerelle::connexion()
{
	
		if (mysql_real_connect(MyS, "mysql-projetserre.alwaysdata.net", "231031_admin", "serre1234", "projetserre_sql", 0, NULL, 0)) {
			return true;
		}
		else {
			return false;
		}
	

}
