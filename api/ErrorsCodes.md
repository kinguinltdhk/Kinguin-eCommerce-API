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

The fields such as: `kind`, `status`, `title`, `detail`, `path`, `method`, `trace` and `timestamps` should be always presented.

The rest of the fields are intended to present the context of the problem. Each of error kind have an own set of custom fields.

> Check `detail` property for more info about the problem.

| Kind                       | Description                                                                                 |
|----------------------------|---------------------------------------------------------------------------------------------|
| `ConstraintViolation`      | The request payload is invalid.                                                             |
| `Error`                    | Unexpected error.                                                                           |
| `HttpClient`               | Internal communication failed.                                                              |
| `Http`                     | Invalid request.                                                                            |
| `Authorization`            | Bad authorization credentials.                                                              |
| `InsufficientBalance`      | There are not enough funds to place order.                                                  |
| `BalanceRequired`          | The balance value is lower than minimum balance required to place order.                    |
| `OrderFailed`              | Order has not been created.                                                                 |
| `ProcessingPreorder`       | Order will be dispatched after product release date.                                        |
| `ProductUnavailable`       | Product has been sold or is not active. Maybe try to update product and send request again. |
| `OrderNotFound`            | Order not found - invalid `orderId` value                                                   |
| `ResourceLock`             | Conflict with current resource state - other process already modified target resource       |
| `OrderNotSupported`        | Order not supported due to platform legacy                                                  |

