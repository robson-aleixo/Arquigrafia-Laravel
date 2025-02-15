# Arquigrafia

The Arquigrafia project intends to research how the individual and the collective
knowledge building processes relate to each other, by sharing subjectivities on interactive and communicative experiences based on an online collective gallery of Brazilian architecture digital images. 

Considering the need for specific iconographic galleries, organized and open for free public access on the Internet, this project gathers a multidisciplinary research team to work on the design and construction of a social network on the Web 2.0 focused on Brazilian architecture digital images, whose operation dynamics will support the study of knowledge building processes. 

So far, the project has focused on photographic images but, in a next step, drawings and
videos will be added. The collective network composed of digital image galleries will complement the current visual bases on Brazilian architecture and, later, may be extended to world architecture. The aim of this project is to stimulate architectural visual culture, promoting interaction between architecture students, teachers,
professional architects and, in a broader approach, among all those interested in architectural images.

Keywords: Architecture, Iconography, Web 2.0, Collaborative Systems, Collective intelligence.

## License

The Arquigrafia project is open-sourced software licensed under the [Creative Commons Attribution 3.0](http://creativecommons.org/licenses/by/3.0/deed.pt_BR).

## Configuration Tutorial

First, it is necessary to configurate the ".env.local.php". There is example of it, called ".example.env.local.php". You need to copy this file and rename to ".env.local.php". Inside the file, you will see the necessary information. In the comentaries, it is explained the difference when tou wanto to execute with a docker or local.

- This project uses Docker, follow these steps to build the environment

> Install Docker, in case you haven't yet.

> Run ```docker-compose build```

> Run ```docker-compose up```

> Run ```docker exec apparquigrafia bash -c "php artisan migrate"```

- This project uses Laravel Messenger for Laravel 4, and needs to run migrate:

> Run ```docker exec apparquigrafia bash -c "php artisan migrate --package=cmgmyr/messenger"```


- The user validation did not work locally for development, because it expects an e-mail confirmation. After creating an user, an error message will appear. Then run the following commands:

- For develop environment, there is a sql script (2019.01.18.sql) to populate databse

- There are functional tests in python programm language, to validate the pages navigation. These tests covarage only admin reports. They are located in python_tests directory. 

```
php artisan tinker
```
```
$p = User::find(1);
```
```
$p->active = true;
```
```
$p->save();
```
```
exit;
```

- Since we're still using PHP 5.6, some JSON post requests might throw an deprecation warning. So, we need to set on PHP.ini:

```
always_populate_raw_post_data = -1
```

## Important comands

### Yarn commands
You can use [yarn](https://yarnpkg.com/en/) to call some comands.

- Starting PHP server

```
$ yarn php
```

- Starting JS server (auto-bundle)

```
$ yarn start
```

- Starting Jest test server

```
$ yarn test:watch
```

- Build JS files for production

```
$ yarn build
```
