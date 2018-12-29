# fake-news

Can you spot which is fake and which is not?

## Setup

To set up the application, first build the necessary docker-containers:

```sh
$ docker-compose build
```

Then install all required dependencies:

```sh
$ docker-compose run --rm api php composer.phar install
$ docker-compose run --rm client npm install
```
