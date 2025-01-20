## API endpoints and their functionalities

- [GET] #Order-Viewing-Page 
- [GET] #Detailed-Order-View 
- [POST] #Create-Order
- [PUT] #Update-Order 
- [DELETE] #Delete-Order 

## General purposes

This project aims to follow coding best practices, respecting S.O.L.I.D principles: 

- Single Responsibility Principle (SRP)
- Open-Closed Principle (OCP)
- Liskov Substitution Principle (LSP) 
- Interface Segregation Principle (ISP) 
- Dependency Inversion Principle (DIP).

According to the specified requirements, concurrency control is used when updating or deleting orders to prevent race conditions (pessimistic locking,  locks + transactions) 

#Order Viewing Page
- Method: GET
- URL: [Base URL] /api/orders
- Description: Retrieves a list of orders with pagination and filtering options

