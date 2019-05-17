#!/bin/bash
echo "Which version would you like to push to production?"

read version

sshpass -p "maximm" scp -r ~/deployment/version$version/ maxim@production:/var/www/html/
