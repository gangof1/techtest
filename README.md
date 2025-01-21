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


- [GET] - [Order Viewing Page](#Order-Viewing-Page) 
- [GET] - [Detailed Order View](#Detailed-Order-View)  
- [POST] - [Create Order](#Create-Order) 
- [PUT] - [Update Order](#Update-Order) 
- [DELETE] - [Delete Order](#Delete-Order)  

## General purposes

This project aims to follow coding best practices, respecting S.O.L.I.D principles: 

- Single Responsibility Principle (SRP)
- Open-Closed Principle (OCP)
- Liskov Substitution Principle (LSP) 
- Interface Segregation Principle (ISP) 
- Dependency Inversion Principle (DIP).

According to the specified requirements, concurrency control is used when updating or deleting orders to prevent race conditions (pessimistic locking,  locks + transactions) 

## Requirements
- Git Installed <a href="https://git-scm.com/downloads">official Git website</a>
- <a href="https://www.docker.com/products/docker-desktop">Docker Desktop</a>
- macOS 10.14 or later, or Windows 10/11 (Pro/Enterprise), or a modern Linux distribution
- PHP ^8.2 (8.4)

## Installation Setup 
- Create a folder and clone this repo from github (digit token when asked to entry password)
```java
git clone https://github.com/gangof1/techtest.git ./
```
- Copy .env.sample file in the root of the project to .env file
```java
cp .env.sample .env
```
- install the application's dependencies executing the following comman <a href="https://laravel.com/docs/11.x/sail#installing-composer-dependencies-for-existing-projects">Official Larevel Hints</a>
```java
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php84-composer:latest \
    composer install --ignore-platform-reqs
```
- Start all of the Docker containers (in background mode)
```java
./vendor/bin/sail up -d
```
- Run application's database migrations and seed products table
```java
./vendor/bin/sail php artisan migrate --seed
```
- This will:
* Run all database migrations to set up the necessary tables.
* Seed tables with some initial data.

#### Hints:
* 500 orders would have been created, each order with 1/2 products assigned with a fixed quantity: 1. 
* 100 Products would have been created too, each with stock set to 500. 
* Consider starting creating a new order or pick an order having #id between 1-500 to test any other API call that require existing order data.


# Order Viewing Page
- Method: GET
- URL: [Base URL] /api/orders
- Description: Retrieves a list of orders with pagination and filtering options
- Response: JSON object of paginated orders with total count and links for next/prev pages
- Response (on failure): JSON reporting error code and message

## Query Parameters

|name|type|mandatory|description|
|---|---|---|---|
|fromdate| date, YYYY-mm-dd| NO| Filter orders created after this date, >= operator|
|todate| date, YYYY-mm-dd| NO| Filter orders created before this date, <= operator|
|name| string| NO| Search for orders containing this name|
|description| string| NO| Search for orders containing this description|

> es. [Base URL] /api/orders?fromdate=2025-01-01&todate=2025-12-31&name=ord&description=ord

### Possible Errors
|Error code|Error Description|
|---|---|
|422| Validation error|


### Response (on success) example
```java
{
    "current_page": 1,
    "data": [
        {
            "id": 5,
            "name": "ordine di test",
            "description": "ordine di test",
            "date": "2025-01-17 16:00:00",
            "created_at": "2025-01-19T15:39:30.000000Z",
            "updated_at": "2025-01-19T15:39:30.000000Z",
            "products": [
                {
                    "id": 1,
                    "name": "quaerat",
                    "price": "471.51",
                    "stock": 7,
                    "created_at": "2025-01-19T14:38:50.000000Z",
                    "updated_at": "2025-01-19T16:17:23.000000Z",
                    "quantity": 1
                },
                {
                    "id": 2,
                    "name": "nam",
                    "price": "346.14",
                    "stock": 5,
                    "created_at": "2025-01-19T14:38:50.000000Z",
                    "updated_at": "2025-01-19T16:17:23.000000Z",
                    "quantity": 1
                }
            ]
        }
    ],
    "first_page_url": "http://localhost/api/orders?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http://localhost/api/orders?page=1",
    "links": [
        {
            "url": null,
            "label": "&laquo; Previous",
            "active": false
        },
        {
            "url": "http://localhost/api/orders?page=1",
            "label": "1",
            "active": true
        },
        {
            "url": null,
            "label": "Next &raquo;",
            "active": false
        }
    ],
    "next_page_url": null,
    "path": "http://localhost/api/orders",
    "per_page": 10,
    "prev_page_url": null,
    "to": 1,
    "total": 1
}

```


# Detailed Order View
- Method: GET
- URL: [Base URL] /api/orders/{order id}*
- Description: Retrieves details about a specific order specified by #id. 
- Response: JSON object of paginated orders, along with associated products, with total count and links for next/prev pages
- Response (on failure): JSON reporting error code and message

> ##### *Please substitute {order id} with desired order #id. 
> ##### es. [Base URL] /api/orders/1

### Possible Errors
|Error code|Error Description|
|---|---|
|404| Resource not found|

### Response (on success) example
```java
{
    "id": 4,
    "name": "Order Consequatur.",
    "description": "Sapiente dicta debitis deserunt repellat quos magnam ullam sit optio culpa.",
    "date": "2025-01-02 12:04:31",
    "created_at": "2025-01-19T14:47:37.000000Z",
    "updated_at": "2025-01-19T14:47:37.000000Z",
    "products": [
        {
            "id": 1,
            "name": "quaerat",
            "price": "471.51",
            "stock": 7,
            "created_at": "2025-01-19T14:38:50.000000Z",
            "updated_at": "2025-01-19T16:17:23.000000Z",
            "quantity": 1
        },
        {
            "id": 5,
            "name": "modi",
            "price": "491.52",
            "stock": 10,
            "created_at": "2025-01-19T14:38:50.000000Z",
            "updated_at": "2025-01-19T14:38:50.000000Z",
            "quantity": 1
        }
    ]
}

```
# Create Order 
- Method: POST
- URL: [Base URL] /api/orders
- Description: Creates a new order
- Response: JSON object representing the newly created order with associated products
- Response (on failure): JSON reporting error code and message

### Request Body (JSON)
```java
{
    "name": "ordine di test",
    "description": "ordine di test",
    "date": "2025-01-17 16:00:00",
    "products": [
        { "id": 1, "quantity": 1 },
        { "id": 2, "quantity": 1 }
    ]
}

```

## Attributes

|name|type|mandatory|description|
|---|---|---|---|
|name| string (unique)| YES| Name of the order|
|description| string| NO| Description of the order|
|date| date, YYYY-mm-dd hh:mm:ss| YES| Date of the order |
|products| array of products| YES| Array of distinct product IDs with quantities|


### Possible Errors
|Error code|Error Description|
|---|---|
|422| Validation error|
|400| Bad Request (stock is not enough?)|

### Response (on success) example
```java
{
    "name": "ordine di test",
    "description": "ordine di test",
    "date": "2025-01-17 16:00:00",
    "updated_at": "2025-01-20T15:51:01.000000Z",
    "created_at": "2025-01-20T15:51:01.000000Z",
    "id": 6,
    "products": [
        {
            "id": 1,
            "name": "quaerat",
            "price": "471.51",
            "stock": 6,
            "created_at": "2025-01-19T14:38:50.000000Z",
            "updated_at": "2025-01-20T15:51:01.000000Z",
            "quantity": 1
        },
        {
            "id": 2,
            "name": "nam",
            "price": "346.14",
            "stock": 4,
            "created_at": "2025-01-19T14:38:50.000000Z",
            "updated_at": "2025-01-20T15:51:01.000000Z",
            "quantity": 1
        }
    ]
}

```

# Update Order
- Method: PUT
- URL: [Base URL] /api/orders/{order id}*
- Description: Updates an existing order
- Response: JSON object representing the updated order with associated products
- Response (on failure): JSON reporting error code and message

> ##### *Please substitute {order id} with desired order #id. 
> ##### es. [Base URL] /api/orders/1

### Request Body (JSON)
```java
{
    "name": "ordine di test",
    "description": "ordine di test",
    "date": "2025-01-17 16:00:00",
    "products": [
        { "id": 1, "quantity": 1 },
        { "id": 2, "quantity": 1 }
    ]
}

```

## Attributes

|name|type|mandatory|description|
|---|---|---|---|
|name| string (unique)| NO| Name of the order (if omitted field won’t be updated)|
|description| string| NO| Description of the order (if omitted field won’t be updated)|
|date| date, YYYY-mm-dd hh:mm:ss| NO| Date of the order (if omitted field won’t be updated)|
|products| array of products| YES| Array of distinct product IDs with quantities|


### Possible Errors
|Error code|Error Description|
|---|---|
|422| Validation error|
|400| Bad Request (stock is not enough?)|
|404| Resource not found|

### Response (on success) example
```java
{
    "id": 1,
    "name": "Ordine di test 1",
    "description": "ordine test",
    "date": "2025-01-19 00:00:00",
    "created_at": "2025-01-19T14:38:56.000000Z",
    "updated_at": "2025-01-19T15:30:26.000000Z",
    "products": [
        {
            "id": 1,
            "name": "quaerat",
            "price": "471.51",
            "stock": 6,
            "created_at": "2025-01-19T14:38:50.000000Z",
            "updated_at": "2025-01-20T17:42:38.000000Z",
            "quantity": 2
        },
        {
            "id": 2,
            "name": "nam",
            "price": "346.14",
            "stock": 4,
            "created_at": "2025-01-19T14:38:50.000000Z",
            "updated_at": "2025-01-20T17:42:38.000000Z",
            "quantity": 2
        }
    ]
}

```

# Delete Order
- Method: DELETE
- URL: [Base URL] /api/orders/{order id}*
- Description: Deletes a specific order
- Response: JSON object indicating success of the operation.
- Response (on failure): JSON reporting error code and message

> ##### *Please substitute {order id} with desired order #id. 
> ##### es. [Base URL] /api/orders/1

### Possible Errors
|Error code|Error Description|
|---|---|
|404| Resource not found|

### Response (on success) example
```java
{
    "success": true,
    "message": "Order deleted successfully"
}

