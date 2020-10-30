# How to buy PRE-ORDER

**Requirements for buying PRE-ORDER**

1. Buying PRE-ORDER with key type is not allowed.
2. Buying PRE-ORDER must be the only item in ordered products.
3. Buying PRE-ORDER with regular products is not allowed.

### How to dispatch PRE-ORDER

PRE-ORDER product can be dispatched only after its release date. 
If you try to dispatch it before then API will return error in below format:

```json
{
    "kind": "ProcessingPreorder",
    "status": 422,
    "title": "Unprocessable Entity",
    "detail": "PRE-ORDER will be dispatched after release date.",
    "path": "/api/v2/order/PHS84FJAG5U/dispatch",
    "method": "POST",
    "trace": "082a4cee9b",
    "timestamp": "2020-09-01T13:06:06+00:00",
    "orderId": "PHS84FJAG5U",
    "releaseDate": "2020-12-10",
    "retryable": true
}
```
