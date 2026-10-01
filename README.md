# ITechAcademy
just me testing my skills and relying on couple of documentation , no ai generated code !!

## Features
- Students: <register, log in, browse the catalog, enroll, see "My courses">
- Admin: <manage courses, trainers, enrollments via EasyAdmin>
- Security: <roles, access control, CSRF on enrollment>

## Tech stack
- PHP 8.5.3, Symfony v8.1.8
- MySQL 8.0.44, Doctrine ORM + Migrations
- Twig, Bootstrap 5 (CDN)
- EasyAdmin <version>

## Getting started
Requirements: <PHP, Composer, MySQL, Symfony CLI>
you only need to run composer install in your terminal because
Every package i installed (ORM, Security, EasyAdmin, Maker, fixtures, and so on) is recorded in composer.json and composer.lock

1. Clone the repo and 'cd' into it
2. run 'composer install'
3. Copy '.env' to '.env.local' and set 'DATABASE_URL'
4. create the database : php bin/console doctrine:database:create
5. run the migrations : php bin/console create:migration and then  php bin/console doctrine:migration:migrate
6. load the fixtures : php bin/console doctrine:fixtures:load
7. start the server : symfony serve, then open <URL>

## Test accounts
| Role    | Email | Password |
|---------|-------|----------|
| Admin   | ...   | ...      |
| Student | ...   | ...      |

ps : Why styling is minimal
The time limit was two days, so the effort went into the data model, security, and the enrollment logic first. Bootstrap is loaded for the navbar , and the layout is functional

## Author
SaidSouli
