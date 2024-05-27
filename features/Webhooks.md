# Webhooks

* [Product updated webhook](#product-updated-webhook)
* [Order status changed webhook](#order-status-changed-webhook)

# Headers

Each webhook contains a set of predefined headers:

| Header name      | Header value       |
|------------------|--------------------|
| `X-Event-Name`   | Webhook event name |
| `X-Event-Secret` | Your secret key    |

## Product updated webhook

The webhook is triggered when product was changed, became out of stock or when new offer became available.

### Example payload

Content-Type: `aplication/json`

`X-Event-Name` header: `product.update`

Request method: `POST`

```json
{
   "kinguinId": 1949,
   "productId": "5c9b5f6b2539a4e8f172916a",
   "qty": 845,
   "textQty": 845,
   "cheapestOfferId":["611222acff9ca40001f0b020"],
   "updatedAt": "2020-10-16T11:24:08.015+00:00"
}
```

| Field             |   Type   | Description                                |
|-------------------|:--------:|--------------------------------------------|
| `kinguinId`       |   int    | Product ID                                 |
| `productId`       |  string  | Another product ID                         |
| `qty`             |   int    | Total quantity from the cheapest offers    |
| `textQty`         |   int    | Quantity of `text` type serials            |
| `cheapestOfferId` | string[] | List of cheapest product ids               |
| `updatedAt`       |  string  | Date of change in format `Y-m-d\TH:i:s.vP` |


## Order status changed webhook

The webhook is triggered when an order status was changed.

### Example payload

Content-Type: `aplication/json`

`X-Event-Name` header: `order.status`

Request method: `POST`

```json
{
   "orderId": "PHS84FJAG5U",
   "orderExternalId": "AL2FEEHOO2OHF",
   "status": "canceled",
   "updatedAt": "2020-10-16T11:24:08.025+00:00"
}
```

| Field             |  Type  | Description                                              |
|-------------------|:------:|----------------------------------------------------------|
| `orderId`         | string | Order ID                                                 |
| `orderExternalId` | string | Order external ID                                        |
| `status`          | string | [Order Status](../api/order/v1/README.md#order-statuses) |
| `updatedAt`       | string | Date of change in format `Y-m-d\TH:i:s.vP`               |

### How to register webhooks

1. Login to your [Dashboard](https://www.kinguin.net/integration/dashboard/stores).
2. Go to **MY STORES** section and view store details.
3. Click on **WEBHOOKS** button.
4. Fill configuration form and click **SUBMIT** button.
5. Before saving, you can check if your endpoint responds correctly by clicking on **TEST URL** button.
6. Configure secret key to authorize incoming webhooks.


### Webhooks handling

Any webhook endpoint has to respond with any `2xx` status code and with empty body. If not, we will try to retry delivery several times.
After all failure retries the webhook will be rejected.

> We recommend to use **204 No Content** status.

> Keep in mind, that we are allowed to disable your endpoint when too many failed responses have been detected.

Webhooks are sent asynchronously, so the order in which they are sent may not be preserved.
To keep your data consistent store and validate the `updatedAt` property which is provided in each notification.
