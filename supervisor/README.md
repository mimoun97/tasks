Path:
`/etc/supervisor/conf.d/tasks.mimoun1997.scool.cat.conf`

Contingut:
+ LOCAL:

```bash
[program:laravel-worker-tasks-mimoun1997-scool-cat]
process_name=%(program_name)s_%(process_num)02d
command=php /home/mimoun/Code/mimoun1997/tasks/artisan queue:work redis --sleep=3 --tries=3
autostart=true
autorestart=true
user=mimoun
numprocs=8
redirect_stderr=true
stdout_logfile=/home/mimoun/Code/mimoun1997/tasks/storage/logs/worker.log
```

+ EXPLOTACIÓ:
```bash
[program:laravel-worker-tasks-mimoun1997-scool-cat]
process_name=%(program_name)s_%(process_num)02d
command=php /home/forge/tasks.mimoun1997.scool.cat/artisan queue:work redis --sleep=3 --tries=3
autostart=true
autorestart=true
user=forge
numprocs=8
redirect_stderr=true
stdout_logfile=/home/forge/tasks.mimoun1997.scool.cat/storage/logs/worker.log
```