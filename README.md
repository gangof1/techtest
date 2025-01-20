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

# Order Viewing Page
- Method: GET
- URL: [Base URL] /api/orders
- Description: Retrieves a list of orders with pagination and filtering options
- Response: JSON array of paginated orders with total count and links for next/prev pages
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
- Response: JSON array of paginated orders, along with associated products, with total count and links for next/prev pages
- Response (on failure): JSON reporting error code and message

> ##### *Please substitute {order id} with desired order #id. 
> ##### es. [Base URL] /api/orders/1

### Possible Errors
|Error code|Error Description|
|---|---|
|422| Validation error|

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

# Update Order

# Delete Order
