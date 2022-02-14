# Webhooks

* [Product updated webhook](#product-updated-webhook)
* [Order completed webhook](#order-completed-webhook)
* [Order status changed webhook](#order-status-changed-webhook)

# Headers

Each webhook contains a set of predefined headers:

Header name | Header value
--------- | ---------
`X-Event-Name` | Webhook event name
`X-Event-Secret` | Your secret key


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
   "price": 4.45,
   "cheapestOfferId":["611222acff9ca40001f0b020"],
   "updatedAt": "2020-10-16T11:24:08.015+00:00"
}
```

Field |   Type   | Description
--------- |:--------:| -----------
`kinguinId` |   int    | Product ID
`productId` |  string  | Another product ID
`qty` |   int    | Total quantity of cheapest product
`textQty` |   int    | Quantity of `text` type serials
`price` |  float   | Cheapest product price
`cheapestOfferId` | string[] | List of cheapest product ids
`updatedAt` |  string  | Date of change in format `Y-m-d\TH:i:s.vP`


## Order completed webhook

The webhook is triggered when an order was dispatched and status was changed to `completed`. Purchased keys are ready to download.

### Example payload

Content-Type: `aplication/json`

`X-Event-Name` header: `order.complete`

Request method: `POST`

```json
{
   "orderId": "PHS84FJAG5U",
   "orderExternalId": "AL2FEEHOO2OHF",
   "updatedAt": "2020-10-16T11:24:08.015+00:00"
}
```

Field | Type | Description
--------- | :-----: | -----------
`orderId` | string | Order ID
`orderExternalId` | string | Order external ID
`updatedAt` | string | Date of change in format `Y-m-d\TH:i:s.vP`


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

Field | Type | Description
--------- | :-----: | -----------
`orderId` | string | Order ID
`orderExternalId` | string | Order external ID
`status` | string | [Order Status](../api/order/v1/README.md#order-statuses)
`updatedAt` | string | Date of change in format `Y-m-d\TH:i:s.vP`

### How to respond for webhooks

For each webhook your endpoint must respond with status `2xx`.
After the first failure response we will try to resend webhook a couple of times at appropriate intervals.

> Keep in mind, that we are allowed to disable your endpoint when we detect too many failed responses. You should be notified about that case by e-mail.


### How to register webhooks

1. Login to your [Dashboard](https://www.kinguin.net/integration/dashboard/stores).
2. Go to **MY STORES** section and view store details.
3. Click on **WEBHOOKS** button.
4. Fill configuration form and click **SUBMIT** button.
5. Before saving, you can check if your endpoint responds correctly by clicking on **TEST URL** button.
6. Configure secret key to authorize incoming webhooks.
