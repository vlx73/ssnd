# Basic Docker operations

### Files in docker directory

- [Dockerfile](Dockerfile)
  Commands for building custom image locally.
- [docker-compose.yml](docker-compose.yml)
  Commands for bulding, services where each service is a container
- [docker-custom-php.ini](docker-custom-php.ini)
  Custom php.ini file for our custom image
- [docker-php-ext-xdebug.ini](docker-php-ext-xdebug.ini)
  Custom xdebug.ini file for our custom image
- [.env.dist](.env.dist) docker environment variables file for distributaion in git
- [.env](.env) docker environment variables file for local use only based on .dist file

# Basic docker commands

List all running containers

```bash
docker ps
```

Start services configured in local docker-compose.yml and leave the console open

```bash
docker compose up
```

Start services configured in local docker-compose.yml and detach console

```bash
docker compose up --detach
```

and stop them with

```bash
docker compose down
```

Build custom image where the build is in defined in docker-compose.yml

```bash
docker compose build
```

Build custom image where the build is in defined in Dockerfile as part of docker-compose containers configuration and
after build run all containers

```bash
docker compose up --build
```

List all images

```bash
docker images
```

List all containers

```bash
docker ps -a
```

Remove all containers

```bash
docker rm $(docker ps -a -q)
```

list all networks

```bash
docker network ls
```

inspect specific network

```bash
docker network inspect <network_name>
```