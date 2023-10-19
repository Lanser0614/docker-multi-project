# docker multi environment for development

## How to use


1. Create new laravel project 
2. add or Copy conf file on folder docker\nginx
3. Configure your conf file. 
4. in conf file edit root /var/www/your-project-folder-name/public;
5. in conf file edit listen 80; to other free port
6. in docker-compose file add new port to list 


| Services | Version |
|----------|---------|
| php      | 8.1     |
| Mariadb  | 10.6.5  |
| Redis    | latest  |
| MailHog  | latest  |
| Nginx    | latest  |
| Composer | latest  |
| Postgres | latest  |
| PgWeb    | latest  |
| Adminer  | latest  |
