# How to dispatch order

Order can be dispatched manually by sending direct request:

```bash
curl -X POST \
     -H 'X-Api-Key: [api-key]' \
     -H 'Content-Type: application/json' \
     https://gateway.kinguin.net/esa/api/v2/order/PHS84FJAG5U/dispatch
```

Due to the asynchronous nature of order processing, the API may return an error marked as `retryable`. 
This means that the order is still being processed. 
As long as the API returns an `retryable` error, the request should be retried at appropriate intervals.
The exception to the rule are **PRE-ORDER** products, where the request should be retried only after **release date**.

### Postback notifications to the rescue

The other way to complete order is to omit sending request to API and register [postback notification](Postback.md). 
When order has been dispatched the service will send an event to your registered endpoint. 
It means, the order status is completed and all purchased keys are ready to download.
The main advantage is that your application does not need to send requests at appropriate intervals, which means it should run more efficiently and integration is simpler.

### Example postback notification

```json
{
   "orderId": "PHS84FJAG5U",
   "orderExternalId": "AL2FEEHOO2OHF",
   "updatedAt": "2020-10-16T11:24:08+00:00"
}
```

After that, you can use `orderId` value and send request for keys.

```bash
curl -X GET \
     -H 'X-Api-Key: [api-key]' \
     https://gateway.kinguin.net/esa/api/v2/order/PHS84FJAG5U/keys
```
