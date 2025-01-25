[⬅️ Back to home](../README.md)

# Update Order
- Method: PATCH
- URL: [Base URL] /api/orders/{order id}*
- Description: Updates an existing order
- Response (on success): JSON object representing the updated order with associated products
- Status code (on success): 200
- Response (on failure): JSON reporting error code and message

> ##### *Please substitute {order id} with desired order #id. 
> ##### es. [Base URL] /api/orders/1

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
|name| string (unique)| NO| Name of the order (if omitted field won’t be updated)|
|description| string| NO| Description of the order (if omitted field won’t be updated)|
|date| date, YYYY-mm-dd hh:mm:ss| NO| Date of the order (if omitted field won’t be updated)|
|products| array of products| YES| Array of distinct product IDs with quantities|


### Possible Errors
|Error code|Error Description|
|---|---|
|422| Validation error|
|400| Bad Request (stock is not enough)|
|404| Resource not found|

### Response (on success) example
```
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
