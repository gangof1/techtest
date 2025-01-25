[⬅️ Back to home](../README.md)

# Order Viewing Page
- Method: GET
- URL: [Base URL] /api/orders
- Description: Retrieves a list of orders - ordered by date desc - with pagination and filtering options
- Response (on success): JSON object of paginated orders with total count and links for next/prev pages 
- Status code (on success): 200
- Response (on failure): JSON reporting error code and message

## Query Parameters

|name|type|mandatory|description|
|---|---|---|---|
|fromdate| date, YYYY-mm-dd| NO| Filter orders created after this date, >= operator considering start of the day|
|todate| date, YYYY-mm-dd| NO| Filter orders created before this date, <= operator considering end of the day|
|name| string| NO| Search for orders containing this name|
|description| string| NO| Search for orders containing this description|
|page|integer| NO| page number|

> es. [Base URL] /api/orders?fromdate=2025-01-01&todate=2025-12-31&name=ord&description=ord

### Possible Errors
|Error code|Error Description|
|---|---|
|422| Validation error|


### Response (on success) example
```
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
