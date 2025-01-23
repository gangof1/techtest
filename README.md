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
Though not implemented at present, API's are supposed to be, in a future release, accessible only through "personal access tokens" (Laravel Sacntum, token should be included in the Authorization header as a Bearer token)
To prevent SQL Injections, the app makes use of validation of user inputs and of Eloquent ORM (parameterized queries, SQL bindings) 

## Requirements
- macOS 10.14 or later, or Windows 10/11 (Pro/Enterprise), or a modern Linux distribution
- Git Installed <a href="https://git-scm.com/downloads">official Git website</a>
- <a href="https://www.docker.com/products/docker-desktop">Docker Desktop</a> installed

## Documentation
- [Setup Guide](docs/setup.md)
- [Consuming API Guide](docs/api.md)
    * [Order Viewing Page](docs/api_order_viewing_page.md)
    * [Detailed Order View](docs/api_detailed_order_view.md)
    * [Create Order](docs/api_crate_order.md)
    * [Update Order](docs/api_update_order.md)
    * [Delete Order](docs/api_delete_order.md)
- [Testing Instructions](docs/testing.md)

# Detailed Order View
- Method: GET
- URL: [Base URL] /api/orders/{order id}*
- Description: Retrieves details about a specific order specified by #id. 
- Response: JSON object displaying order information along with associated products
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
```

## Testing 
In the root of the project, execute
```java
./vendor/bin/sail php artisan test
```
to run all APIs tests

 
##### Order Viewing Page
- [x] it returns a successful response
- [x] it handles wrong date when provided
##### Detailed Order View
- [x] it returns a successful response
- [x] it returns products belonging to order
##### Create Order
- [x] route is valid
- [x] it validates the input data
- [x] it returns an error if stock is not enough
- [x] it returns an error if products are not unique
- [x] store success
##### Update Order
- [x] it updates order with valid data
- [x] it returns an error if products are not defined
- [x] it returns an error if product have quantity set to zero
##### Delete Order
- [x] it delete order 
