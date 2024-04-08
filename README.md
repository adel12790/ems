<h1 align="center">Event management system (PHP, VueJS)</h1>


<!-- Body -->

## 🚀 How to run

Clone the repository in your computer.

```bash
$ git clone https://github.com/adel12790/ems
$ cd php-docker-nginx-redis
```

Run docker-compose file

```bash
$ docker-compose up -d
```
Run frontend side (working on including it in the docker compose):
```bash
cd fe/app
yarn dev
```

You can find ems_db.sql dump under `config/mysql/docker-entrypoint-initdb.d` that can be imported manually, as the auto database initialization on docker container build had some issues and

## ⚙️ Configuration

Don't forget to configure the environment variables file so that the project works correctly.

Duplicate the file `.env.example` changing name to `.env` and then fill the variables.

```bash
$ cp .env.example .env
```

Example config
```py
# Redis configuration
REDIS_PORT=6379
REDIS_PASSWORD=difficultpassword

# PostgreSQL configuration
POSTGRESQL_USER=root
POSTGRESQL_PASSWORD=difficultpassword
POSTGRESQL_DATABASE=default_db

# Mysql configuration
MYSQL_USER=test
MYSQL_DATABASE=database
MYSQL_PASSWORD=difficultpassword
```

---

<!-- Footer -->
Developed by [Mohamed Adel](https://github.com/adel12790).
