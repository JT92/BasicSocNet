# Laravel - Basic Social Network Example

This is a basic social network style site built using Laravel 5.3.
The site allows users to register/login and then create posts which they and other users can like/dislike.
The user can also change his name in an account settings page as well as upload a picture to the app storage.

## Models

The site uses the following 3 basic model objects:

### User

| Column        | Type           | Relation|
| ------------- | -------------- | ------- |
| id            | increments     | primary |
| email         | string         |         |
| name          | string         |         |
| password      | string(hashed) |         |

>The User object stores information about the user. For this example, it only contains the email, name, and password.
>A user can create and like many posts. He has a **one-to-many** relationship to likes and posts.

### Post

| Column        | Type           | Relation       |
| ------------- | -------------- | -------------- |
| id            | increments     | primary        |
| user_id       | interger       | foreign (user) |
| content       | string         |                |

>The Post model stores the posts created by users. The post as a **many-to-one** relationship to users and a one-to-many
>relationship to likes. 

### Like

| Column        | Type           | Relation        |
| ------------- | -------------- | --------------- |
| id            | increments     | primary         |
| user_id       | interger       | foreign (user)  |
| post_id       | interger       | foreign (post)  |
| like          | boolean        |                 |

>The Like model is used to store what posts have been liked by what users. It simply stores whether a post
>has been liked or disliked. If a user removes his like/dislike, the row is deleted.
>The like object has a **many-to-one** relationship to a user, and a **many-to-one** relationship to a post.

The models were created using Laravel's Eloquent ORM, and they are implemented as MySQL tables.

## Controllers
The project uses two controllers: a User Controller and a Post Controller

##### User Controller
>This controls all of the user related functionality. This includes creating a user, loging in/out, 
>and showing/modifying the accout information.

##### Post Controller
>This controls all of the post related functionality. This includes the Post CRUD management, the dashboard display, 
>and liking/disliking posts.

## Front End Design
The front end was created using JavaScript, JQuery, AJAX, CSS, and Bootsrap.

---

<br/>
<br/>
<br/>
<br/>

# Laravel PHP Framework

[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/d/total.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as authentication, routing, sessions, queueing, and caching.

Laravel is accessible, yet powerful, providing tools needed for large, robust applications. A superb inversion of control container, expressive migration system, and tightly integrated unit testing support give you the tools you need to build any application with which you are tasked.

## Official Documentation

Documentation for the framework can be found on the [Laravel website](http://laravel.com/docs).

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](http://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
