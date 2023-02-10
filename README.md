## About Test
</br>
the env file to use it is necessary copy env.example and renemer to .env
</br>
</br>
## websockets Laravel </br>
</br>
all config information Mail and websocket to use in front (Angular or react) with Echo
</br>
 </br>
PUSHER_APP_ID=123456  </br>
PUSHER_APP_KEY=qwerty1212 </br>
PUSHER_APP_SECRET=qb45U7f93acL8r </br>
PUSHER_APP_CLUSTER=mt1 </br>
</br></br></br>

## websockets Laravel  </br>
if you need to run websockets :       php artisan websockets:serve  </br>
and the link of to show all event :   http://127.0.0.1:8000/laravel-websockets </br>


## for cron job to 'Implémenter une tâche cron qui s'exécutera tous les minuits'

At last, we have to add one line in the server crontab file. For that first open the cron file with bellow command. </br></br>
</br>
=>   crontab -e
</br>
and put the bellow line at the end of the file, </br>
</br>
</br>
* * * * * cd /var/www/html/cronjob && php artisan schedule:run >> /dev/null 



