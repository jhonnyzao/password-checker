# Password Checker

A simple set of classes which serve a script to check passwords

### Prerequisites

In order to run this application, you need to download:

```
Docker (version 18.09)
Docker-compose (version 1.17)
```

Don't forget to follow [these instructions](https://docs.docker.com/install/linux/linux-postinstall/) after installing Docker.

## Getting Started

Clone this project and create your own _.env_ file with the following command:

```
cp .env.example .env
```

The rules.yaml file contains all the password validation rules and is located at the root of this project. You can edit it or specify a new rules yaml file. Just make sure to update you _.env_ file if you choose the second option.

### Installing

After creating your _.env_ file, go to the root of the project (where _docker-compose.yml_ is located) and run the following command:

```
docker-compose up
```

After all the images are downloaded and the containers are up, open another terminal tab and run the command to access your application container prompt:

```
docker-compose run app ash
```

You will be prompted to the project root inside the container. There, you will find the bootstrap file for the checker script, called **main.php**. To update all the rows of the passwords table in database, you just need to run:

```
php main.php
```

Optionally, you can specify a new password via command line as a parameter to check if it is valid:

```
php main.php samplepassword
```

All the code outputs and errors are being written in _STDOUD_ and _STDERR_ respectively. You can use them to generate log reports with a telemetry service.

If you need to put your container down for some reason, you can face some permission issues when putting it up again: the app container creates new files and directories (such as data/ or vendor/) as root. To make sure you can up the container again, you must either change these items permissions with chmod, use docker as sudo (*sudo docker-compose up --build*) or simply delete them (*sudo rm -rf composer.lock vendor/ data/*).

## Running the tests

Still from the project root inside the container, run the following command:

```
./vendor/bin/phpunit tests/
```

## Deploy

If this application is going to be deployed to a production environment, a multi staged Dockerfile should be written, using intermediate images to install dependencies (with composer install --no-dev), so composer doensn't need to be installed to the final image.

Tests should be executed only during the pipeline, so tests directory shouldn't be deployed too.

## Authors

* **João Armando** - *Initial work* - [Linkedin](https://www.linkedin.com/in/jo%C3%A3o-armando-moretti-ferreira-30114a99/)
