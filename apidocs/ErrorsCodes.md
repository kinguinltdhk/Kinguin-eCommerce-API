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
1101 | 404 | Order not found
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