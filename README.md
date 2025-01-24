<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## API endpoints

#### Base URL: http://localhost
#### Content-Type: application/json


- [GET] - [Order Viewing Page](docs/api_order_viewing_page.md) 
- [GET] - [Detailed Order View](docs/api_detailed_order_view.md)  
- [POST] - [Create Order](docs/api_create_order.md) 
- [PATCH] - [Update Order](docs/api_update_order.md) 
- [DELETE] - [Delete Order](docs/api_delete_order.md)  

## General purposes

This project aims to follow coding best practices, respecting DRY (Don't Repeat Yourself), KISS(Keep it simple) and S.O.L.I.D principles: 

- Single Responsibility Principle (SRP)
- Open-Closed Principle (OCP)
- Liskov Substitution Principle (LSP) 
- Interface Segregation Principle (ISP) 
- Dependency Inversion Principle (DIP).

## Logic
According to the specified requirements, concurrency control is used when updating or deleting orders to prevent race conditions (pessimistic locking,  locks + transactions) 

To enhance order search functionality, API Order Viewing Page interacts with Laravel Scout/Meilisearch  to implement indexing solution to manage efficient searching and filtering

## Security
Though not implemented yet, API's are supposed to be, in a future release, accessible only through "personal access tokens" (Laravel Sacntum, token should be included in the Authorization header as a Bearer token)
To prevent SQL Injections, the app makes use of validation of user inputs and of Eloquent ORM (parameterized queries, SQL bindings) 

## Requirements
- macOS 10.14 or later, or Windows 10/11 (Pro/Enterprise), or a modern Linux distribution
- Git Installed <a href="https://git-scm.com/downloads">official Git website</a>
- <a href="https://www.docker.com/products/docker-desktop">Docker Desktop</a> installed

## Installation / setup
Please see [Setup Guide](docs/setup.md) to proceed

## Documentation
- [API Consumption Guide](docs/api.md)
    * [Order Viewing Page](docs/api_order_viewing_page.md)
    * [Detailed Order View](docs/api_detailed_order_view.md)
    * [Create Order](docs/api_create_order.md)
    * [Update Order](docs/api_update_order.md)
    * [Delete Order](docs/api_delete_order.md)
- [Testing Instructions](docs/testing.md)

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
