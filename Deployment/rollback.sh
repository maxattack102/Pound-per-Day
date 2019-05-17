#!/bin/bash

echo "Would you like to roll back Production or QA?"

read rollback

echo "Which version would you like to rollback to?"

read version

if [[ "$rollback" = "QA" || "$rollback" = "qa" ]]; then
	sshpass -p "maximm" scp -r ~/deployment/version$version/ maxim@192.168.2.147:/var/www/html/
elif [[ "$rollback" = "Production" || "$rollback" = "production" ]];then
	sshpass -p "maximm" scp -r ~/deployment/version$version/ maxim@192.168.2.147:/var/www/html/
else
	echo "Invalid input"
fi
