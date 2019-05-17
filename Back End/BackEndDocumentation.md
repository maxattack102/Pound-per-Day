In our backend server, we have a lot of documentations that are essentials, but we will not go through them, because they are merely  suport files for RabbitMQ

Our Important Back End Files - 

	-  dbConnection 	  -  As with any program that has a connection to a database, we set up a file determined to be looked at when needed a databse
	-  dbFunctions  	  -  When our server is requested something from the client such as login and register, this file is the one that is viewed to see which function is the respective one
	-  dbServer           -  This file stores the type of server action you can take and which function to go with via a switch case
	-  databaseDV.service -  The service file for the database, so that it can run automatically on boot
	
As stated before, the other files you see above are just the essentials to creating an AMQP connection, because that is where it starts. After we get an AMQP Request from the Front End it goes through the dbServer that recieves it, checks it, and sends it to the proper function that connects to the database and excutes using sql commands in php.  