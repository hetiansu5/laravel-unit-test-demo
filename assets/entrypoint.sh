#!/bin/bash

echo "Configuring Develop Environment..."

dirName="unit.test";

echo "Configuring Nginx"
cp -r /www/${dirName}/assets/nginx/* /etc/nginx/conf.d/

mkdir /www/log
service nginx start
service php-fpm start

while true
do
    echo "hello world" > /dev/null
    sleep 6s
done