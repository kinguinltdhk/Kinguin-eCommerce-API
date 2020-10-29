# Errors Codes

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

Check `detail` property for more info about the problem.

Kind | Description
-----|------------------
`ConstraintViolation` | The message payload is invalid.
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
`Preorder` | Problem with buying preorder. See `detail` for more info.
`ProcessingPreorder` | Order will be dispatched after product release date.
`ProductUnavailable` | Product has been sold or is not active. Maybe try to update product and send request again.
`OrderNotFound` | Order not found - invalid `orderId` value
`DispatchNotFound` | Dispatch not found - invalid `dispatchId` value

## Retryable kinds

- `OrderHold`
- `OrderNotDispatchedYet`
- `OrderPartiallyDispatched`
- `ProcessingPreorder`

Retryable kinds should have set additional property `retryable` with `true`.

It means that the order is being processed and the request should be repeated until the correct response from API will be received.
