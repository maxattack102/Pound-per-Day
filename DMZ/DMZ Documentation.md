DMZ is the way our front end talks to the api’s that we need without it having accessing or connecting the backend.

DMZ Server Files
	
-	dmzClient.php - receives requests from any site requesting API systems to get their result and sends the requests to the AMQP, which later sends back information from the server, so that the Client is able to put the information in the requested area 
-	testRabbitMQ.ini - the file that stores the requirements needed to communicate via AMQP
-	dmzFunction.php - stores all the functions that is used in the DMZ Server 
-	dmzServer.php - activates the functions through the response given by the request in the DMZ Client, which is sent through AMQP and back out to the client so that it can be put in the template
-	template.php - the template established to receive the responses from the client

As you will recognize while reviewing our code both the template.php and the dmzClient.php will be shown twice, because it is imperative to show that even though they are not used in the server side, they are a very important part of the DMZ and its functions.
