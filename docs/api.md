[⬅️ Back to home](../README.md)

API Consumption
Interacting with Restful APIs, can be done using various tools and programming languages. Here are some common methods: cURL, Guzzle, JavaScript, Postman (User-friendly UI)

Example using cURL:
```
curl -X GET "[base URL]/api/orders" -H "Accept: application/json"
```
Using Postman:
* Open Postman and select the desired HTTP method (GET, POST, PATCH, DELETE).
* Enter the appropriate API URL.
* For POST and PATCH requests, include the request body or parameters as needed.

A postman collection (v2.1) for testing purpose is available in `docs` folder, see [TechTest.postman_collection](TechTest.postman_collection.json).

For more detailed instructions, refer to each endpoint's section in this documentation.
