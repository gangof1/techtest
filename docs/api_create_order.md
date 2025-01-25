[⬅️ Back to home](../README.md)

# Create Order 
- Method: POST
- URL: [Base URL] /api/orders
- Description: Creates a new order
- Response (on success): JSON object representing the newly created order with associated products 
- Status code (on success): 201
- Response (on failure): JSON reporting error code and message

### Request Body (JSON)
```
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
|400| Bad Request (stock is not enough)|

### Response (on success) example
```
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
