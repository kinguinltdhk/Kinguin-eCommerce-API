# Postback notifications

Kind | Description
--------- | -----------
`product.update` | Notification, when product or offer was changed
`order.complete` | Notification, when order status was changed to `completed`


## Product updates notifications

These notifications are sent when product or offer details change, or when new offers become available.

### Example payload

Content-Type: `aplication/json`

Request method: `POST`

```json
{
   "kinguinId": 1949,
   "updatedAt": "2020-10-16T11:24:08+00:00"
}
```

Field | Type | Description
--------- | :-----: | -----------
`kinguinId` | int | Product ID
`updatedAt` | string | Date of change


## Order complete notifications

These notifications are sent when order has been dispatched. Purchased keys are ready to download.

### Example payload

Content-Type: `aplication/json`

Request method: `POST`

```json
{
   "orderId": "PHS84FJAG5U",
   "orderExternalId": "AL2FEEHOO2OHF",
   "updatedAt": "2020-10-16T11:24:08+00:00"
}
```

Field | Type | Description
--------- | :-----: | -----------
`orderId` | string | Order ID
`orderExternalId` | string | Order external ID
`updatedAt` | string | Date of change


## How to respond for postback notifications

For each postback notification your endpoint should respond with status `2xx`.
After first bad response we will try to resend notification a couple of times.

> Keep in mind, that we are allowed to disable your endpoint when we detect too many failed responses. You should be notified about that case by e-mail.


## How to configure postback notifications

1. Login to your [Dashboard](https://www.kinguin.net/integration/dashboard/stores).
2. Go to **My stores** section.
3. View your store details and click on **Postback notifications** button in the top right corner.
4. Fill URL and mark **Active**.
5. Before saving, you can check if your endpoint responds correctly by clicking on **TEST URL** button.

> Please keep in mind that every notification endpoint should be placed into the same host as store url.
