# Errors codes

In case of error API returns HTTP status code different from `2xx` and JSON object in below format:

```json
{
    "kind": "ConstraintViolation",
    "status": 400,
    "title": "Bad Request",
    "detail": "Invalid \"products\" property. Sum of total values of \"qty\" must be lower than or equal 90.",
    "path": "/api/v1/order",
    "method": "POST",
    "trace": "082a4cee9b",
    "timestamp": "2020-09-01T13:06:06+00:00",
    "propertyPath": "products",
    "invalidValue": 100
}
```

> Check `detail` property for more info about the reason.

### Table of error codes

| Kind                  | Description                                               |
|-----------------------|-----------------------------------------------------------|
| `ConstraintViolation` | The requested payload is invalid.                         |
| `Error`               | Unexpected error.                                         |
| `HttpClient`          | Internal request failed.                                  |
| `Http`                | Invalid http request.                                     |
| `Authorization`       | Bad authorization credentials.                            |
| `InsufficientBalance` | There are not enough funds to place an order.             |
| `OrderFailed`         | Unable to create an order.                                |
| `Preorder`            | Pre-orders validation error.                              |
| `ProductUnavailable`  | Unable to find any offer matching order request criteria. |
| `OrderNotFound`       | Order not found.                                          |
| `ResourceLock`        | Conflict with current resource version.                   |
| `OrderNotSupported`   | Order not supported due to platform legacy.               |
| `NoKeysToReturn`      | Return keys is not allowed for current resource version.  |

