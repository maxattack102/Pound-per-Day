#!/bin/bash

sudo systemctl start databaseDV.service

sshpass -p "123456" ssh -t walther@192.168.2.144 "cd /var/www/html/ sudo rm -r testRabbitMQ.ini;"
cd /home/danny/Documents/HotStandBy/ 
sshpass -p "123456" scp testRabbitMQ.ini walther@"192.168.2.144":/home/walther/Documents
sshpass -p "123456" ssh -t walther@192.168.2.144 "cd /home/walther/Documents; sudo cp testRabbitMQ.ini /var/www/html"
sshpass -p 123456 ssh -t walther@192.168.2.144 "sudo systemctl restart apache2.service"
