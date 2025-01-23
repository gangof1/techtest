[⬅️ Back to home](../README.md)

API Consumption
To interact with the Restful API, we recommend using cURL or Postman.

Example using cURL:
```java
curl -X GET "[base URL]/api/orders" -H "Accept: application/json"
```
Using Postman:
* Open Postman and select the desired HTTP method (GET, POST, PUT, DELETE).
* Enter the appropriate API URL.
* For POST and PUT requests, include the request body or parameters as needed.

A postman collection for testing purpose is available in `docs` folder, see [TechTest.postman_collection](TechTest.postman_collection)

For more detailed instructions, refer to each endpoint's section in this documentation.
