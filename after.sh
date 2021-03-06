#!/usr/bin/env bash

echo "Composer"
php /home/vagrant/importservice/composer.phar update

echo "Running migrations"
php /home/vagrant/importservice/artisan migrate

echo "Installing Supervisor"
sudo apt-get install supervisor -y > /dev/null

echo "
[program:lumen-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /home/vagrant/importservice/artisan queue:work --tries=3
autostart=true
autorestart=true
numprocs=4
stdout_logfile=/home/vagrant/importservice/storage/logs/worker.log
" > /etc/supervisor/conf.d/lumen-worker.conf

echo "Starting Supervisor"
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start lumen-worker:*