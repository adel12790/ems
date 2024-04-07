<h1 align="center">Event management system (PHP, VueJS)</h1>

<!-- Tags -->

<p align="center">
  <img alt="License" src="https://img.shields.io/static/v1?label=license&message=MIT&color=ffffff&labelColor=000000">
  <img alt="Nginx" src="https://img.shields.io/static/v1?label=Nginx&message=latest&color=ffffff&labelColor=000000">
  <img alt="PHP" src="https://img.shields.io/static/v1?label=PHP&message=8.X&color=ffffff&labelColor=000000">
  <img alt="Redis" src="https://img.shields.io/static/v1?label=Redis&message=latest&color=ffffff&labelColor=000000">
  <img alt="MySQL" src="https://img.shields.io/static/v1?label=MySQL&message=5.7.24&color=ffffff&labelColor=000000">
  <img alt="PHPMyAdmin" src="https://img.shields.io/static/v1?label=PHPMyAdmin&message=latest&color=ffffff&labelColor=000000">
</p>
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
