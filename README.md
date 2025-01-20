<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## API endpoints and their functionalities

Base URL: http://localhost
Content-Type: application/json

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


# Detailed Order View
- Method: GET
- URL: [Base URL] /api/orders/{order id}
- Description: Retrieves details about a specific order specified by #id. 
		     
> Please substitute {order id} with desired order #id. 

- Response: JSON array of paginated orders, along with associated products, with total count and links for next/prev pages

# Create Order 

# Update Order

# Delete Order
