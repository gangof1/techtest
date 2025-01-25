[⬅️ Back to home](../README.md)

## Testing 
In the root of the project, execute
```
./vendor/bin/sail php artisan test
```
to run all APIs tests

### List of implemented tests:

##### Order Viewing Page
- [x] it returns a successful response
- [x] it handles wrong date when provided
##### Detailed Order View
- [x] it returns a successful response
- [x] it returns products belonging to order
##### Create Order
- [x] route is valid
- [x] it validates the input data
- [x] it returns an error if stock is not enough
- [x] it returns an error if products are not unique
- [x] store success
##### Update Order
- [x] it updates order with valid data
- [x] it returns an error if products are not defined
- [x] it returns an error if product have quantity set to zero
##### Delete Order
- [x] it delete order 
