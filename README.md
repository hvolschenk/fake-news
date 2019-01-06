# fake-news

Can you spot which is fake and which is not?

## Prerequisites

Before running the application, make sure to have `docker` and `docker-compose` installed on your
system. _Docker for Mac_ and _Docker for Windows_ both already contain both.

## Setup (Once off)

To set up the application, first build the necessary docker-containers:

```sh
$ docker-compose build
```

Then install all required dependencies:

```sh
$ docker-compose run --rm api php composer.phar install
$ docker-compose run --rm client npm install
```

## Running the application

### Starting up

To start up the application after all the above steps have been followed, simply run the following
command:

```sh
$ docker-compose up
```

This will start up all three services (`api`, `client` and `database`).

The `client` service will be available in your browser through
[https://0.0.0.0:4000](https://0.0.0.0:4000).

The `api` service is either available on it's own through
[https://0.0.0.0:4001](https://0.0.0.0:4001) or  it can be proxied by adding `/api` the the `client`
service's URL ([https://0.0.0.0:4000/api](https://0.0.0.0:4000/api)).

The `database` service will be available through the standard MySql port, `3306`.

### Stopping

While the application is running it will take up the current terminal tab, it can be killed by
pressing `Crtl + C`. This merely stops the containers, making them available for faster startup.

To completely stop the application (and reset the database), stop the running application with
`Ctrl + C` and then run the command:

```sh
$ docker-compose down
```

## Working with data

To import the list of titles, start up the application, then run the following in your terminal:

```sh
$ curl http://0.0.0.0:4001/question/import
```

This will import the `.csv` list from `/api/assets/file/titles.csv`. This file needs the following
columns (in order): `id`, `question`, `answer` (`True`, `False`), `num_comments`, `score` and
`created_utc`.

## Other useful docker commands

### Stop and remove images

To stop all three containers, and remove the images, run the following command:

```sh
$ docker-compose down --rmi all
```

This is useful if you feel an image or container is corrupt, and want to rather ebuild it from
scratch.

### Working with containers

#### Listing all containers

To list all containers run the following command:

```sh
$ docker ps -a
```

#### Stopping a container

To stop a container you need to get it's id from the listing (above), then run the command:

```sh
$ docker stop container_id
```

#### Removing a container

To remove a container it first needs to be stopped (see above). You need to get it's id from the
listing (above), then run the command:

```sh
$ docker rm container_id
```

### Working with images

#### Listing all images

To list all images run the following command:

```sh
$ docker images
```

#### Removing an image

To remove an image you need to get it's id from the listing (above), then run the following command:

```sh
$ docker rmi image_id
```
