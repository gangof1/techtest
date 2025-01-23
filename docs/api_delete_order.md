[⬅️ Back to home](../README.md)

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
