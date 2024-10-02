# Orders API

Version: `v1`

## Table of Contents

- [Place an order](#place-an-order)
- [Get order](#get-order)
- [Search orders](#search-orders)


## Place an order

`POST /v1/order`

### Input

Content-Type: `application/json`

```json
{
    "products": [
        {
            "kinguinId": [int],
            "qty": [int],
            "price": [float],
            "keyType": [string],
            "offerId": [string]
        },
        (...)
    ],
    "orderExternalId": [string],
    "couponCode": [string]
}
```

| Field                |  Type  | Required | Description                                                                                                                               |
|----------------------|:------:|:--------:|-------------------------------------------------------------------------------------------------------------------------------------------|
| `products.kinguinId` |  int   |   Yes    | Product identifier from `kinguinId` field                                                                                                 |
| `products.qty`*      |  int   |   Yes    | Quantity                                                                                                                                  |
| `products.price`     | float  |   Yes    | Your price                                                                                                                                |
| `products.keyType`   | string |    No    | Specify the type of key. The possible value is `text`. When the value is not provided, then the random type of the key will be delivered. |
| `products.offerId`** | string |    No    | Specify the exact offer you want to buy, otherwise the API will select offers according to the given price and available quantity.        |
| `orderExternalId`    | string |    No    | Custom reference to the order in your service. The value should be unique.                                                                |
| `couponCode`         | string |    No    | The discount code                                                                                                                         |

> *The `qty` limit per offer is `9`. The maximum number of unique items in `products` is `10`. For the wholesale purchase the limit is `1k`
> **This field is required only for wholesale purchases

### Output

HTTP Status: `201`

Content-Type: `application/json`

Returns the [Order Object](#order-object)

### Example request

```bash
curl -X POST \
     -H 'X-Api-Key: [api-key]' \
     -H 'Content-Type: application/json' \
     -d '{"products":[{"kinguinId":1949,"qty":1,"price":5.79}]}' \
     https://gateway.kinguin.net/esa/api/v1/order
```

### Example response

```json
{
    "totalPrice": 5.79,
    "requestTotalPrice": 5.79,
    "status": "processing",
    "userEmail": "...@kinguin.io",
    "storeId": 1,
    "createdAt": "2020-10-28T08:40:44+00:00",
    "orderId": "PHS84FJAG5U",
    "orderExternalId": "AL2FEEHOO2OHF",
    "couponCode": "ESA",
    "paymentPrice": 5.29,
    "products": [
        {
            "kinguinId": 1949,
            "offerId": "5f7efd272f3a650001f42722",
            "productId": "5c9b68662539a4e8f17ae2fe",
            "qty": 1,
            "name": "Counter-Strike: Source Steam CD Key",
            "price": 5.79,
            "totalPrice": 5.79,
            "requestPrice": 5.79,
            "isPreorder": true,
            "releaseDate": "2020-10-07",
            "keyType": "text",
            "accurate": true,
            "broker": "internal"
        }
    ],
    "totalQty": 1,
    "isPreorder": true,
    "preorderReleaseDate": "2020-10-07"
}
```

Also read:

- [Buying pre-orders](../../../features/BuyingPreorders.md)


## Get order

`GET /v1/order/{orderId}`

### URL variables

| Field     |  Type  | Required | Description |
|-----------|:------:|:--------:|-------------|
| `orderId` | string |   Yes    | Order ID    |

### Output

HTTP Status: `200`

Content-Type: `application/json`

Returns the [Order Object](#order-object)

### Example request

```bash
curl -X GET \
     -H 'X-Api-Key: [api-key]' \
     https://gateway.kinguin.net/esa/api/v1/order/PHS84FJAG5U
```

### Example response

```json
{
    "totalPrice": 5.79,
    "requestTotalPrice": 5.79,
    "status": "processing",
    "userEmail": "...@kinguin.io",
    "storeId": 1,
    "createdAt": "2020-10-28T08:40:44+00:00",
    "orderId": "PHS84FJAG5U",
    "orderExternalId": "AL2FEEHOO2OHF",
    "couponCode": "ESA",
    "paymentPrice": 5.29,
    "products": [
        {
            "kinguinId": 1949,
            "offerId": "5f7efd272f3a650001f42722",
            "productId": "5c9b68662539a4e8f17ae2fe",
            "qty": 1,
            "name": "Counter-Strike: Source Steam CD Key",
            "price": 5.79,
            "totalPrice": 5.79,
            "requestPrice": 5.79,
            "isPreorder": true,
            "releaseDate": "2020-10-07",
            "keyType": "text",
            "accurate": true,
            "broker": "internal"
        }
    ],
    "totalQty": 1,
    "isPreorder": true,
    "preorderReleaseDate": "2020-10-07"
}
```

### Order Object

| Field                   |  Type  | Description                                          |
|-------------------------|:------:|------------------------------------------------------|
| `totalPrice`            | float  | Order sell price                                     |
| `requestTotalPrice`     | float  | Order requested price                                |
| `paymentPrice`          | string | Balance amount charged for this order                |
| `status`                | string | [Order Status](#order-statuses)                      |
| `userEmail`             | string | E-mail of the order owner                            |
| `kidId`                 |  int   | ID of the order owner                                |
| `storeId`               |  int   | Store ID                                             |
| `createdAt`             | string | Order creation date                                  |
| `orderId`               | string | Order ID                                             |
| `kinguinOrderId`        |  int   | Previous order ID                                    |
| `orderExternalId`       | string | Order external ID                                    |
| `couponCode`            | string | Discount code                                        |
| `isPreorder`            |  bool  | Pre-order                                            |
| `totalQty`              |  int   | Total quantity from products                         |
| `preorderReleaseDate`   | string | Release date                                         |
| `products.kinguinId`    |  int   | Product ID                                           |
| `products.offerId`      | string | Offer ID                                             |
| `products.productId`    | string | Another product ID                                   |
| `products.qty`          |  int   | Ordered quantity                                     |
| `products.name`         | string | Product name                                         |
| `products.price`        | float  | Product sell price                                   |
| `products.totalPrice`   | float  | Total product sell price                             |
| `products.requestPrice` | float  | Product request price                                |
| `products.isPreorder`   |  bool  | Pre-order                                            |
| `products.releaseDate`  | string | Product release date                                 |
| `products.keyType`      | string | Serial type for product                              |
| `products.accurate`     |  bool  | Determines if sell price is equal to requested price |
| `dispatch.id`           |  int   | Dispatch ID **DEPRECATED**                           |
| `dispatch.createdAt`    | string | Dispatch creation date **DEPRECATED**                |

## Search orders

`GET /v1/order`

### Query parameters

| Parameter         |  Type  | Description                                                                               |
|-------------------|:------:|-------------------------------------------------------------------------------------------|
| `page`            |  int   | Page number (default: `1`)                                                                |
| `limit`           |  int   | Limit results (default: `25`, maximum: `100`)                                             |
| `totalPriceFrom`  | float  | Total price from                                                                          |
| `totalPriceTo`    | float  | Total price to                                                                            |
| `createdAtFrom`   | string | Date in formats `Y-m-d`, `Y-m-d H:i:s`, `Y-m-dTH:i:s`, `Y-m-dTH:i:s.uZ` or `Y-m-dTH:i:sP` |
| `createdAtTo`     | string | Date in formats `Y-m-d`, `Y-m-d H:i:s`, `Y-m-dTH:i:s`, `Y-m-dTH:i:s.uZ` or `Y-m-dTH:i:sP` |
| `kinguinId`       |  int   | Product ID                                                                                |
| `productId`       | string | Another product ID                                                                        |
| `orderId`         | string | Order ID                                                                                  |
| `kinguinOrderId`  |  int   | Previous order ID                                                                         |
| `orderExternalId` | string | Order external ID                                                                         |
| `name`            | string | Product name                                                                              |
| `status`          | string | [Order Status](#order-statuses)                                                           |
| `isPreorder`      | string | Pre-order (values: `yes` or `no`)                                                         |

### Output

HTTP Status: `200`

Content-Type: `application/json`

| Field        |   Type   | Description                                        |
|--------------|:--------:|----------------------------------------------------|
| `results`    | object[] | Array of [Order Object](#order-object)             |
| `item_count` |   int    | Total number of available orders matching criteria |

### Example request

```bash
curl -X GET \
     -H 'X-Api-Key: [api-key]' \
     https://gateway.kinguin.net/esa/api/v1/order?status=processing
```

### Example response

```json
{
    "results": [
        {
            "totalPrice": 5.79,
            "requestTotalPrice": 5.79,
            "status": "processing",
            "userEmail": "...@kinguin.io",
            "storeId": 1,
            "createdAt": "2020-10-28T08:40:44+00:00",
            "orderId": "PHS84FJAG5U",
            "orderExternalId": "AL2FEEHOO2OHF",
            "couponCode": "ESA",
            "paymentPrice": 5.29,
            "products": [
                {
                    "kinguinId": 1949,
                    "offerId": "5f7efd272f3a650001f42722",
                    "productId": "5c9b68662539a4e8f17ae2fe",
                    "qty": 1,
                    "name": "Counter-Strike: Source Steam CD Key",
                    "price": 5.79,
                    "totalPrice": 5.79,
                    "requestPrice": 5.79,
                    "isPreorder": true,
                    "releaseDate": "2020-10-07",
                    "keyType": "text",
                    "accurate": true,
                    "broker": "internal"
                }
            ],
            "totalQty": 1,
            "isPreorder": true,
            "preorderReleaseDate": "2020-10-07"
        }
    ],
    "item_count": 1
}
```

### Order Statuses

|    Status    | Description                                       |
|:------------:|---------------------------------------------------|
| `processing` | Order is waiting for delivering the keys          |
| `completed`  | Order is completed (all keys have been delivered) |
|  `canceled`  | Order has been canceled                           |
|  `refunded`  | Order has been refunded                           |
