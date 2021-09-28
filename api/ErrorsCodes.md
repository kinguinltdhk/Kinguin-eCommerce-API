# Errors codes

In case of error API returns HTTP status code different than `2xx` and JSON object in below format:

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

The fields such as: `kind`, `status`, `title`, `detail`, `path`, `method`, `trace` and `timestamps` should be always presented.

The rest of the fields are intended to present the context of the problem. Each of error kind have an own set of custom fields.

> Check `detail` property for more info about the problem.

Kind | Description
-----|------------------
`ConstraintViolation` | The request payload is invalid.
`Error` | Unspecified error.
`HttpClient` | Internal communication failed.
`Http` | Invalid request.
`Authorization` | Bad authorization credentials.
`InsufficientBalance` | There are not enough funds to place order.
`BalanceRequired` | The balance value is lower than minimum balance required to place order.
`OrderFailed` | Order has not been created.
`OrderHold` | Order has been hold. Dispatch has been blocked.
`OrderNotDispatchedYet` | Order has not been dispatched yet. Please try send request again.
`OrderNotPaid` | Problem with payment with balance.
`OrderPartiallyDispatched` | Not of all products has been dispatched yet. Please try send request again.
`Preorder` | Problem with buying PRE-ORDER. See `detail` for more info.
`ProcessingPreorder` | Order will be dispatched after product release date.
`ProductUnavailable` | Product has been sold or is not active. Maybe try to update product and send request again.
`OrderNotFound` | Order not found - invalid `orderId` value
`DispatchNotFound` | Dispatch not found - invalid `dispatchId` value
`ResourceLock` | Conflict with current resource state - other process already modified target resource
`OrderNotSupported` | Order not supported due to platform legacy

## Retryable kinds

- `OrderHold`
- `OrderNotDispatchedYet`
- `OrderPartiallyDispatched`
- `ProcessingPreorder`
- `ResourceLock`
- `OrderFailed`

Due to the asynchronous nature of order processing, the API may return an error marked as `retryable`. 
It means, that the order is not completed yet.
As long as the API returns an `retryable` error, the request should be retried at appropriate intervals.
The exception to the rule are PRE-ORDER products, where the request should be retried only after product release date.

> Instead of sending requests at appropriate intervals you can register a [webhook](../features/Webhooks.md#order-completed-webhook).

### Example retryable error

```json
{
    "kind": "OrderNotDispatchedYet",
    "status": 422,
    "title": "Unprocessable Entity",
    "detail": "Order \"PHS84FJAG5U\" not dispatched yet. Please retry request later",
    "path": "/api/v1/order/dispatch",
    "method": "POST",
    "trace": "082a4cee9b",
    "timestamp": "2020-09-01T13:06:06+00:00",
    "orderId": "PHS84FJAG5U",
    "retryable": true
}
```
