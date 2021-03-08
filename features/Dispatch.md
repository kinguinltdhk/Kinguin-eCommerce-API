# How to dispatch order

Order can be dispatched manually by sending request:

```bash
curl -X POST \
     -H 'X-Api-Key: [api-key]' \
     -H 'Content-Type: application/json' \
     https://gateway.kinguin.net/esa/api/v2/order/PHS84FJAG5U/dispatch
```

Due to the asynchronous nature of order processing, the API may return an error marked as `retryable`. 
It means, that the order is not completed yet.
As long as the API returns an `retryable` error, the request should be retried at appropriate intervals.
The exception to the rule are **PRE-ORDER** products, where the request should be retried only after **release date**.

### Webhooks to the rescue

The other way to complete order is register [webhooks](Webhooks.md).
The webhook will be sent after order has been dispatched.
It means, that order status is `completed` and all purchased keys are ready to download.
Your application does not need to send requests for dispatch, so the integration is simpler and efficient.

### Example webhook

```json
{
   "orderId": "PHS84FJAG5U",
   "orderExternalId": "AL2FEEHOO2OHF",
   "updatedAt": "2020-10-16T11:24:08+00:00"
}
```

After that, you can use `orderId` value and make request for keys.

```bash
curl -X GET \
     -H 'X-Api-Key: [api-key]' \
     https://gateway.kinguin.net/esa/api/v2/order/PHS84FJAG5U/keys
```

### Backoff strategy

In some cases order can be canceled or refunded.
To handle such events you should register a [webhook](Webhooks.md#order-status-changed-webhook) for tracking changes of your order.

Also, to get current order status you can use [Order Details](../api/order/v1/README.md#get-order) endpoint.
