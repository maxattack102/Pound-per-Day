HotStandBy Files

	-  checkconnection.sh - As it states it checks if it can ping the primary server
	-  takethewheel.sh    - Changes the ini file at the Front-End so that it connects to the HotStandBy Machine 
	-  testRabbitMQ.ini   - The file it replaces the original ini file with
	
We have checkconnection.sh on crontab, where it checks every minute, if it's on. if not it starts the service via takethweel.sh, where it replaces the ini file in the Front-End with the one in the this file.
