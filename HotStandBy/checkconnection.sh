#!/bin/bash

hostip=192.168.2.135
ping -c1 hostip 1>/dev/null 2>/dev/null
connected=$?

if [$connected -eq 0]
then
	echo "$hostip connected"
else
	echo "$hostip not connected"
	'/home/danny/Documents/HotStandBy/takethewheel.sh'
fi
#EOF
