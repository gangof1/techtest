[⬅️ Back to home](../README.md)

# Detailed Order View
- Method: GET
- URL: [Base URL] /api/orders/{order id}*
- Description: Retrieves details about a specific order specified by #id. 
- Response (on success): JSON object displaying order information along with associated products
- Status code (on success): 200
- Response (on failure): JSON reporting error code and message

> ##### *Please substitute {order id} with desired order #id. 
> ##### es. [Base URL] /api/orders/1

### Possible Errors
|Error code|Error Description|
|---|---|
|404| Resource not found|

### Response (on success) example
```
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
