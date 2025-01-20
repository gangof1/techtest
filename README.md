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

# Detailed Order View
Method: GET
URL: [Base URL] /api/orders/{order id}
Description: Retrieves details about a specific order specified by #id. 
		     Please substitute {order id} with desired order #id. 

# Create Order 

# Update Order

# Delete Order
