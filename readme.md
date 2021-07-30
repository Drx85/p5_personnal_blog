# p5_personnal_blog
Blog made with Vanilla PHP, Twig, and Bootstrap.

## About The Project

I made this little blog to improve my skills in PHP, in the context of my PHP/Symfony OpenClassRooms formation.
Your comments and suggestions are welcome.

### Constraints

This blog must :
*   Contains posts listed in a page with an overview of each post + its number of comments + author + title + last update date if exists
*   Each post have its own page, which display all the post content + its comments + a form to add comments for connected users
*   Implement admin/publisher/member accounts
*   Implement an admin interface with restricted access
*   Have possibility to create/update/delete posts and to delete/validate comments when connected as admin or publisher
*   Manually validate by admin or publisher each new comment sent
*   Have possibility to promote to publisher or to demote to member users when connected as admin
*   Have a form contact in homepage
*   Not use any framework, composer libraries are tolerated
*   Avoid security fails like XSS, CSRF, SQL injection, session hijacking, injection of PHP scripts
*   Be monitored by Codacy and Code Climate

### Built With

*   🐘️ PHP 7.4.9
*   ⛵ phpMyAdmin 5.0.2
*   🐬  MySQL 5.7.31
*   ✒️Apache 2.4.46
*   ⛕️Git 2.31.1.windows.1
*   🌿 Twig 3<p>&nbsp;</p>
*   🖊️ Dia for UML
*   🖊️ Draw.io for UML
*   🐬 MySQL Workbench for UML

### Code quality

Codacy : [![Codacy Badge](https://app.codacy.com/project/badge/Grade/3c111cac19694d47b6ff3f355633f431)](https://www.codacy.com/gh/Drx85/p5_personnal_blog/dashboard?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=Drx85/p5_personnal_blog&amp;utm_campaign=Badge_Grade)

Code Climate : [![Maintainability](https://api.codeclimate.com/v1/badges/206f2e8eeaa601e365ad/maintainability)](https://codeclimate.com/github/Drx85/p5_personnal_blog/maintainability)

## Getting Started

To get a copy up and running follow these simple steps.

### Prerequisites

*   PHP 7.4.9

*   SMTP server with mailing service or XAMPP/WAMP for local use (mails will not work in local)

*   MySQL DMBS like phpMyAdmin :
https://docs.phpmyadmin.net/fr/latest/setup.html

*   Libraries will be installed using Composer (PHP Mailer, Inflector, Twig, Michelf MarkDown)

*   CSS libraries are directly called via CDN (Bootstrap 5.0.2, Font Awesome 5)

### Installation

## Clone / Download

1.  Git clone the repository from this page. **See** [GitHub Documentation](https://docs.github.com/en/github/creating-cloning-and-archiving-repositories/cloning-a-repository-from-github/cloning-a-repository)

##Database

1.  Create new Database in your favorite MySQL DMBS 
2.  Import ***blog.sql*** file in this new Database

## Config 

1.  Open ***app/Config.php*** file, then replace all fields with your own information 
2.  If you are missing any information, ask you webhost for SMTP and Database credentials

## Install all dependencies
1.  Install Composer if you don't have it yet. **See** [Composer Documentation](https://getcomposer.org/download/)

2.  In your CMD, move on your project directory using cd command :
```sh
cd your/directory
```
    
3.  Run : 
```sh
composer install
```
All dependencies should be installed in a vendor directory.

## Usage

### Online example version

Please see an hosted example version [**here**](http://deperne.fr/p5_personnal_blog/public/index.php)

## Contact

Cédric Deperne - cedric@deperne.fr

Project Link: [https://github.com/Drx85/p5_personnal_blog](https://github.com/Drx85/p5_personnal_blog)
