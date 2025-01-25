[⬅️ Back to home](../README.md)

# Delete Order
- Method: DELETE
- URL: [Base URL] /api/orders/{order id}*
- Description: Deletes a specific order
- Response (on success): JSON object indicating success of the operation.
- Status code (on success): 200
- Response (on failure): JSON reporting error code and message

> ##### *Please substitute {order id} with desired order #id. 
> ##### es. [Base URL] /api/orders/1

### Possible Errors
|Error code|Error Description|
|---|---|
|404| Resource not found|
|400| Error|

### Response (on success) example
```
{
    "success": true,
    "message": "Order deleted successfully",
    "status": 200
}
```
