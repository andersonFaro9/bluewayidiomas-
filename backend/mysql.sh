#!/bin/bash

if [[ ! -f /var/log/mysql/all.log ]]; then
    touch /var/log/mysql/all.log
fi

chmod 777 /var/log/mysql/all.log
mysql -u root -p -e "SET global log_output = 'FILE'; SET global general_log_file='/var/log/mysql/all.log'; SET global general_log = 1;"