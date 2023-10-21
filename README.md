# docker multi environment for development

## How to use


1. Create new laravel project 
2. add or Copy conf file on folder docker\nginx
3. Configure your conf file. 
4. in conf file edit root /var/www/your-project-folder-name/public;
5. in conf file edit listen 80; to other free port
6. in docker-compose file add new port to list 


| Services      | Version | username | password                 |
|---------------|---------|----------|--------------------------|
| php           | 8.1     |
| Mariadb       | 10.6.5  | root     | 123                      |
| Redis         | latest  |
| MailHog       | latest  |
| Nginx         | latest  |
| Composer      | latest  |
| Postgres      | latest  | username | password                 |
| PgWeb         | latest  |
| Adminer       | latest  |
| rabbitmq      | latest  | guest    | guest                    |
| neo4j         | latest  | neo4j    | CHANGETHISIFYOURENOTZUCK |
| kafka         | latest  |          |                          |
| kafka-ui      | latest  |          |                          |
| mongo-db      | latest  | mongo    | 123                      |
| mongo-express | latest  | admin    | changeme                      |
| ElasticSearch | latest  | admin    | changeme                      |
| kibana        | latest  | admin    | changeme                      |
