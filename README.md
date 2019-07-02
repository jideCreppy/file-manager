# File API Manager

### Requirements: 

 [Composer](https://getcomposer.org/), [npm](https://www.npmjs.com/get-npm), [Docker](https://www.docker.com/)


# STEPS:
```php
RUN: npm install -g testcafe
```

## Change directory to the applications folder within file-manager
```php
RUN: composer install
```

## Start Containers
```php
 In the projects root directory run docker-compose up
```

## Import SQL file using phpmyadmin

```php
 Enter localhost:8000 on a web browser
 User: user , Password: password
 Import file_manager.sql into the file_manager database 
 (the required file_manager.sql file is saved the project root folder)
```

## Open Project
```php
 Navigate to localhost:8081/public
```

## Upload Files
```php
Two sample files are provided in the samplefiles folder within project root folder
```

## Download Files
```php
 To download a file click on the file name
```

## Delete Files
```php
 To delete files click on the delete button
```

## Automated Test

```php
Change directory to the project root folder
RUN: testcafe chrome test/test.js
```