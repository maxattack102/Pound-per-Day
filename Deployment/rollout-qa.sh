#!/bin/bash

version=1
cd ~/deployment/
while : 
do
	if [ ! -d "version$version" ]; then
		mkdir "version$version"
		cd version$version
		echo "$version" > version.txt
		
		sshpass -p "maximm" scp -r maxim@192.168.2.141:/var/www/html/ ~/deployment/version$version/
		sshpass -p "maximm" scp -r ~/deployment/version$version/ maxim@192.168.2.147:/var/www/html/
		
		break
	else
		let "version=version+1"
	fi
done
