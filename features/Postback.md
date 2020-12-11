# Postback notifications

Kind | Description
--------- | -----------
**Product update** | Notification, when product was changed
**Order complete** | Notification, when order status was changed to `completed`


## Product update notification

The **Product update** notification is triggered when product is changed, or when new offer become available.

The webhook will be triggered if at least one of the bellowed product/offer fields has changed.

Field |
--------- |
`qty` |
`textQty` |
`totalQty` |
`offersCount` |
`price` |
`status` |
`releaseDate` |

### Example payload

Content-Type: `aplication/json`

Request method: `POST`

```json
{
   "kinguinId": 1949,
   "productId": "5c9b5f6b2539a4e8f172916a",
   "updatedAt": "2020-10-16T11:24:08+00:00"
}
```

Field | Type | Description
--------- | :-----: | -----------
`kinguinId` | int | Product ID
`productId` | string | Another product ID
`updatedAt` | string | Date of change in format `Y-m-d\TH:i:sP`


## Order complete notification

The **Order complete** notification is triggered when an order has been dispatched. Purchased keys are ready to download.

> Webhook is triggered only for users that have been migrated to the new pool of products. Ask your business manager for more info.

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
`updatedAt` | string | Date of change in format `Y-m-d\TH:i:sP`


## How to respond for notification

For each postback notification your endpoint should respond with status `2xx`.
After first bad response we will try to resend notification a couple of times at appropriate intervals.

> Keep in mind, that we are allowed to disable your endpoint when we detect too many failed responses. You should be notified about that case by e-mail.


## How to configure postback notifications

1. Login to your [Dashboard](https://www.kinguin.net/integration/dashboard/stores).
2. Go to **MY STORES** section.
3. View your store details and click on **POSTBACK NOTIFICATIONS** button in the top right corner.
4. Fill URL and mark as **Active**.
5. Before saving, you can check if your endpoint responds correctly by clicking on **TEST URL** button.

> Please keep in mind that every notification endpoint should have the host that is equal to your store host.
