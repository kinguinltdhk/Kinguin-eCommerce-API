# Errors codes

In case of error API returns HTTP Status code different than 2xx and JSON object with code and message in below format:
```
{
    "code": [int]
    "message": [string]
}
```

## List of error codes

Code | HTTP Status Code | Description
-----|------------------|-----------------------
1000 | 500 | Internal Server Error
1001 | 401 | Unauthorized
1002 | 400 | Quantity validation error
1003 | 404 | Product not found
1004 | 400 | Invalid product type
1005 | 400 | Invalid product status (should be `active`)
1006 | 400 | Invalid product quantity
1007 | 500 | Internal Server Error
1008 | 400 | Insufficient balance
1009 | 500 | Internal Server Error
1010 | 500 | Internal Server Error
1100 | 500 | Internal Server Error
1101 | 404 | Order not found
1102 | 400 | Preorder not ready
1103 | 400 | Order status closed
1104 | 400 | Order status canceled
1400 | 400 | Bad Request
1401 | 401 | Unauthorized
1404 | 404 | Not Found
1500 | 500 | Internal Server Error
1503 | 503 | Service Unavailable
2400 | 400 | Bad Request
2401 | 401 | Unauthorized
2404 | 404 | Not Found
2405 | 405 | Method Not Allowed
2500 | 500 | Internal Server Error
2503 | 503 | Service Unavailable
2601 | 400 | Query parameter validation error
2602 | 404 | Order not found
2603 | 404 | Dispatch not found
2604 | 401 | Unauthorized
2605 | 400 | Invalid content type (should be `json`)
2607 | 400 | Balance amount below minimum value
2608 | 401 | Unauthorized
2609 | 400 | Order request validation error
2610 | 400 | Invalid product `qty`, `price` or product not found
2611 | 500 | Internal Server Error
2612 | 401 | Unauthorized
2613 | 400 | Insufficient balance
3400 | 400 | Bad Request
3404 | 404 | Not Found
3405 | 405 | Method Not Allowed
3500 | 500 | Internal Server Error
3503 | 503 | Service Unavailable
3601 | 404 | Product not found
3602 | 400 | Query parameters validation error
3603 | 404 | Category not found

Check `message` parameter in error response for more detailed description.

Example error response:
```
{
    "code": 3602,
    "message": "Parameter \"priceFrom\" should be numeric"
}
```

# New error response format

**DEPRECATED since end of September 2020**

Example new error response format
```json
    {
        "kind": "ConstraintViolation",
        "status": 400,
        "title": "Bad Request",
        "detail": "Invalid \"products\" property. Sum of total values of \"qty\" must be lower than or equal 100.",
        "path": "/api/v1/order",
        "method": "POST",
        "trace": "082a4cee9b",
        "timestamp": "2020-09-01T13:06:06+00:00",
        "propertyPath": "products",
        "invalidValue": 1000
    }
```

## List of error kinds

**Available since end of September**

Check `detail` property for more info about raised problem.

For any unreasonable errors please contact with us and provide value of `trace` property.

Kind | Description
-----|------------------
ConstraintViolation | Bad request. The message payload is invalid.
Error | Unspecified error.
HttpClient | Internal communication failed.
Authorization | Bad authorization credentials.
InsufficientBalance | There are not enough funds to place order.
OrderHold | Order has been hold. Dispatch has been blocked.
OrderNotDispatchedYet | Order has not been dispatched yet. Please try send request again.
OrderNotPaid | Problem with payment with balance.
OrderPartiallyDispatched | Not of all products has been dispatched yet. Please try send request again.
Preorder | Problem with buying preorder. See `detail` for more info.
ProductUnavailable | Product has been sold or is not active. Maybe try to update product and send request again.


## Retryable kinds

- `OrderHold`
- `OrderNotDispatchedYet`
- `OrderPartiallyDispatched`

Retryable kinds should have set additional property `retryable`.

It means that the order is being processed and the request should be repeated until the correct response from API will be received.
It may happen that for some reasons the order stuck, so you should define a certain limit of requests and contact our Customer Support to resolve a problem.
