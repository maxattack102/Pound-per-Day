Like the Back-End, half of the files are just files dedicated for supoort of RabbitMQ

FrontEnd Files

	-  login.php     	 	   - The file that creates the environment that will later be sent to the server to be chacked if the user exists
	-  register.php  	 	   - Like the previous file, this file sends the information it inputs to the server, but instead of checking it inserts the information into the database
	-  profile.php       	   - After registering, we direct the userr to this site where they will provide their information so that we can account for what their total calories are
	-  preferences.php   	   - We ask the user his preferences, so that we can later understand what the customer might want to go for and so that latr we can reccomend him a` certain food 
	-  ppdClient.php 	 	   - All of the files that are connected to the database, run through this file to get to the Back-End Server
	-  dmzClient.php 	 	   - All of the files that are connected to the DMZ, run through this file to get to the DMZ Server
	-  yelp.php		 	       - This file is the interface for the yelp api which connects to the DMZ that later provides the information for the places to go via the reccomendation of food
	-  viewpref.php    		   - A file that looks at the database to get information of the users preferences
	-  updateprofile.php 	   - Assuming the user loses or gains weight, we had to give the option that they can adjust their profile as to not be eating more than they have to or less than they have to
	-  updatepref.php    	   - Like the previous file, we know people change and so do their preferences
	-  template.php 	       - As explained in the DMZ, this file is the template for the DMZ responses
	-  searchfood.php  	  	   - Similiar to the yelp.php, this code is the interface for a DMZ function
	-  style.css			   - We use this file to keep a constant aesthetic similiarity for most of the sites that we use
	-  foodsearch.html     	   - This is our simple search for food, where people are able to choose what they want to eat
	-  rating.php 		 	   - We set up a file that allows the user to rate what he thought of a restaurant or a food company
	-  index.php 			   - This is our main menu file
	-  food reccomendation.php - An interface for a DMZ function
	-  errors.php			   - The function for error logging
	- calender02.php		   - The file for setting a date with someone, which sends and email out for anyone who would like to meet and go eat sometwhere
	
Everyone starts of the login.php, we have it set up that if you try to access any other file, it will send you back the this page. This allows for greater security and less problesm with the code. If one does not have an account to login to, we provide an option that allows the user to register, assign their proper profile information, and preferences. Once the user is set up, they will be sent to an index page where the user will get to pick, what they want to do either, check where to go eat, what they ate, or what to eat. In additio, if they choose to change their profile, we allow them to go back and fix anything they wish to fix.