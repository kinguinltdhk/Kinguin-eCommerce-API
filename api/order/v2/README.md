# Orders API

Version: `v2`

## Table of Contents

- [Place an order](#place-an-order)
- [Download keys](#download-keys)
- [Return keys](#return-keys)


## Place an order

`POST /v2/order`

### Input

Content-Type: `application/json`

```json
{
    "products": [
        {
            "productId": [string],
            "qty": [int],
            "price": [float],
            "keyType": [string],
            "offerId": [string]
        },
        (...)
    ],
    "orderExternalId": [string]
}
```

| Field                |  Type  | Required | Description                                                                                                                               |
|----------------------|:------:|:--------:|-------------------------------------------------------------------------------------------------------------------------------------------|
| `products.productId` |  int   |   Yes    | Product ID                                                                                                                                |
| `products.qty`*      |  int   |   Yes    | Quantity                                                                                                                                  |
| `products.price`     | float  |   Yes    | Price                                                                                                                                     |
| `products.keyType`   | string |    No    | Specify the type of key. The possible value is `text`. When the value is not provided, then the random type of the key will be delivered. |
| `products.offerId`** | string |    No    | Specify the exact offer you want to buy, otherwise the API will select offers according to the given price and available quantity.        |
| `orderExternalId`    | string |    No    | Custom reference to the order in external system. The value should be unique.                                                             |

> *The `qty` limit for one offer is `9`. The maximum number of items in `products` is `10`. For the wholesale purchases the limit is `1k`
> **This field is required only for wholesale purchases

### Output

HTTP Status: `201`

Content-Type: `application/json`

Returns the [Order Object](../v1/README.md#order-object)

### Example request

```bash
curl -X POST \
     -H 'X-Api-Key: [api-key]' \
     -H 'Content-Type: application/json' \
     -d '{"products":[{"productId":"5c9b68662539a4e8f17ae2fe","qty":1,"price":5.79}]}' \
     https://gateway.kinguin.net/esa/api/v2/order
```
Also read:

- [Buying pre-orders](../../../features/BuyingPreorders.md)



## Download keys

`GET /v2/order/{orderId}/keys`

### URL variables

| Field     |  Type  | Required | Description |
|-----------|:------:|:--------:|-------------|
| `orderId` | string |   Yes    | Order ID    |

### Query parameters

| Parameter | Type | Required | Description                                             |
|-----------|:----:|:--------:|---------------------------------------------------------|
| `page`    | int  |    No    | Page number (default: `1`)                              |
| `limit`   | int  |    No    | Number products on page (default: `25`, maximum: `100`) |

### Output

HTTP Status: `200`

Content-Type: `application/json`

Returns the array of [Key Object](../v2/README.md#key-object)

### Example request

```bash
curl -X GET \
     -H 'X-Api-Key: [api-key]' \
     https://gateway.kinguin.net/esa/api/v2/order/PHS84FJAG5U/keys?page=1
```

### Example response

```json
[
    {
        "id": "67041c31e4d991383ee2a278",
        "serial": "0ddbebb2-559d-42e9-a8e1-fd4b2bdea858",
        "type": "text/plain",
        "name": "Counter-Strike: Source Steam CD Key",
        "kinguinId": 1949,
        "offerId": "5f7efd272f3a650001f42722",
        "productId": "5c9b68662539a4e8f17ae2fe"
    }
]
```

### Key Object

| Field       |  Type  | Description                                                                          |
|-------------|:------:|--------------------------------------------------------------------------------------|
| `id`        | string | Key id                                                                               |
| `name`      | string | Product name                                                                         |
| `type`      | string | Serial content type. Can be `text/plain` or `image/jpeg`, `image/png` or `image/gif` |
| `serial`    | string | Plain text serial key or in case of `image/*` base64 encoded content of the image    |
| `kinguinId` |  int   | Product ID                                                                           |
| `offerId`   | string | Offer ID                                                                             |
| `productId` | string | Product ID                                                                           |

The key is available once it has been delivered to the order. There are few strategies how to download all keys:
1. Call the [Download keys](#download-keys) endpoint periodically using pagination.
2. Register the [order.status](../../../features/Webhooks.md) webhook and download all keys when order status will be `completed`.
3. Load order details [Get Order](../v1/README.md#get-order) periodically and check whether given keys has been delivered.


## Return keys

`POST /v2/order/{orderId}/keys/return`

### URL variables

| Field     |  Type  | Required | Description |
|-----------|:------:|:--------:|-------------|
| `orderId` | string |   Yes    | Order ID    |

### Output

HTTP Status: `200`

Content-Type: `application/json`

| Field    |  Type  | Description                                |
|----------|:------:|--------------------------------------------|
| `id`     | string | Key id                                     |
| `status` | string | [Key Status](../v1/README.md#key-statuses) |


### Example request

```bash
curl -X POST \
     -H 'X-Api-Key: [api-key]' \
     https://gateway.kinguin.net/esa/api/v2/order/PHS84FJAG5U/keys/return
```

### Example response

```json
[
    {
        "id": "67041c31e4d991383ee2a278",
        "status": "DELIVERED"
    },
    {
        "id": "67041c31e4d991383ee2a279",
        "status": "DELIVERED"
    }
]
```

Also read:

- [Return Keys](../../../features/ReturnKeys.md)
