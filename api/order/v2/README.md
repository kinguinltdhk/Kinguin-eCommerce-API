# Orders API

Version: `v2`

## Table of Contents

- [Place an order](#place-an-order)
- [Download keys](#download-keys)


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
            "name": [string],
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
| `products.productId` |  int   |   Yes    | Product identifier from `productId` field                                                                                                 |
| `products.qty`*      |  int   |   Yes    | Quantity                                                                                                                                  |
| `products.price`     | float  |   Yes    | Your price                                                                                                                                |
| `products.keyType`   | string |    No    | Specify the type of key. The possible value is `text`. When the value is not provided, then the random type of the key will be delivered. |
| `products.offerId`** | string |    No    | Specify the exact offer you want to buy, otherwise the API will select offers according to the given price and available quantity.        |
| `orderExternalId`    | string |    No    | Custom reference to the order in your service. The value should be unique.                                                                |
| `couponCode`         | string |    No    | The discount code                                                                                                                         |

> *The `qty` limit per offer is `9`. The maximum number of unique items in `products` is `10`. For the wholesale purchase the limit is `2k`
> > **This field is required only for wholesale purchases

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
| `name`      | string | Product name                                                                         |
| `type`      | string | Serial content type. Can be `text/plain` or `image/jpeg`, `image/png` or `image/gif` |
| `serial`    | string | Plain text serial key or in case of `image/*` base64 encoded content of the image    |
| `kinguinId` |  int   | Product ID                                                                           |
| `offerId`   | string | Offer ID                                                                             |
| `productId` | string | Product ID                                                                           |

The key is available right after it has been delivered to the order. There are 2 strategies how to download the keys:
1. Call the [Download keys](#download-keys) endpoint periodically and parse the response.
2. Register the [order.status](../../../features/Webhooks.md) webhook and download all keys when order status will become `completed`.