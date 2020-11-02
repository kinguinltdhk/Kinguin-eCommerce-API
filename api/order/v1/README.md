# Orders API

Version: `v1`

## Table of Contents

- [Place order](#place-order)
- [Dispatch](#dispatch)
- [Get keys](#get-keys)
- [Key object](#key-object)
- [Get order](#get-order)
- [Order object](#order-object)
- [Search orders](#search-orders)
- [Order statuses](#order-statuses)


## Place order

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

Field | Type | Description
--------- | :-----: | --------
`products.kinguinId` | int | Product ID 
`products.qty` | int | Ordered quantity
`products.price` | float | Requested price
`products.name` | string | Product name
`products.keyType`* | string | [Key type](../../../features/KeyType.md)
`products.offerId`* | string | [Offer ID](../../../features/BuyOffer.md)
`orderExternalId` | string | [Order external ID](../../../features/OrderExternalId.md)
`couponCode`* | string | [Discount code](../../../features/CouponCode.md)

> *feature property, in case of use please contact your business manager

### Output

HTTP Status: `201`

Content-Type: `application/json`

Returns the [Order Object](#order-object)

### Example request

```bash
curl -X POST \
     -H 'X-Api-Key: [api-key]' \
     -H 'Content-Type: application/json' \
     -d '{"products":[{"kinguinId":1949,"qty":1,"name":"Counter-Strike: Source Steam CD Key","price":5.79"}]}' \
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
            "requestPrice": 5.79,
            "isPreorder": true,
            "releaseDate": "2020-10-07",
            "keyType": "text",
            "accurate": true,
            "broker": "internal"
        }
    ],
    "isPreorder": true,
    "preorderReleaseDate": "2020-10-07"
}
```



## Dispatch

`POST /v1/order/dispatch`

### Input

Content-Type: `application/json`

```json
{
    "orderId": [string]
}
```

Field | Type | Description
--------- | :-----: | --------
`orderId` | string | Order ID

### Output

HTTP Status: `201`

Content-Type: `application/json`

```json
{
    "dispatchId": [int]
}
```

Field | Type | Description
--------- | :-----: | --------
`dispatchId` | int | Dispatch ID

### Example request

```bash
curl -X POST \
     -H 'X-Api-Key: [api-key]' \
     -H 'Content-Type: application/json' \
     -d '{"orderId": "PHS84FJAG5U"}' \
     https://gateway.kinguin.net/esa/api/v1/order/dispatch
```

### Example response

```json
{
    "dispatchId": 14169762
}
```



## Get keys

`GET /v1/order/dispatch/keys?dispatchId={dispatchId}`

### Path parameters

Parameter | Type | Description
--------- | :-----: | -----------
`dispatchId` | int | Dispatch ID

### Output

HTTP Status: `200`

Content-Type: `application/json`

Returns the array of [Key Object](#key-object)

### Example request

```bash
curl -X GET \
     -H 'X-Api-Key: [api-key]' \
     https://gateway.kinguin.net/esa/api/v1/order/dispatch/keys?dispatchId=14169762
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

## Key Object

Field | Type | Description
--------- | :-----: | --------
`name` | string | Product name
`type`| string | Serial content type. Can be `text/plain` or `image/jpeg`, `image/png` or `image/gif`
`serial` | string | Plain text serial key or in case of `image/*` base64 encoded content of the image
`kinguinId` | int | Product ID
`offerId` | string | Offer ID
`productId` | string | Another product ID



## Get order

`GET /v1/order/{orderId}`

### Path parameters

Parameter | Type | Description
--------- | :-----: | -----------
`orderId` | string | Order ID

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
            "requestPrice": 5.79,
            "isPreorder": true,
            "releaseDate": "2020-10-07",
            "keyType": "text",
            "accurate": true,
            "broker": "internal"
        }
    ],
    "isPreorder": true,
    "preorderReleaseDate": "2020-10-07"
}
```

## Order Object

Field | Type | Description
--------- | :-----: | --------
`totalPrice` | float | Order sell price
`requestTotalPrice`| float | Order requested price
`paymentPrice` | string | Balance amount charged for this order
`status` | string | [Order Status](#order-statuses)
`userEmail` | string | E-mail of the order owner
`kidId` | int | ID of the order owner
`storeId` | int | Store ID
`createdAt` | string | Order creation date
`orderId` | string | Order ID
`orderExternalId` | string | Order external ID
`couponCode` | string | Discount code
`isPreorder` | bool | PRE-ORDER
`preorderReleaseDate` | string | PRE-ORDER release date
`products.kinguinId` | int | Product ID
`products.offerId` | string | Offer ID
`products.productId` | string | Another product ID
`products.qty` | int | Ordered quantity
`products.name` | string | Product name
`products.price` | float | Product sell price
`products.requestPrice` | float | Product request price
`products.isPreorder` | bool | PRE-ORDER
`products.releaseDate` | string | Product release date
`products.keyType` | string | Serial type for product
`products.accurate` | bool | Determines if sell price is equal to requested price
`products.broker` | string | Offer broker
`dispatch.id` | int | Dispatch ID
`dispatch.createdAt` | string | Dispatch creation date




## Search orders

`GET /v1/order`

### Query parameters

Parameter | Type | Description
--------- | :-----: | -----------
`page` | int | Page number (default: `1`)
`limit` | int | Limit results (default: `25`, maximum: `100`)
`sortBy` | string | Sort field name
`sortType` | string | Sort type (default: `desc`, values: `asc` or `desc`)
`totalPriceFrom` | float | Total price from
`totalPriceTo` | float | Total price to
`createdAtFrom` | string | RFC3339 date
`createdAtTo` | string | RFC3339 date
`kinguinId` | int | Product ID
`orderId` | string | Order ID
`orderExternalId` | string | Order external ID
`name` | string | Product name
`status` | string | [Order Status](#order-statuses)
`isPreorder` | string | PRE-ORDER (values: `yes` or `no`)

### Output

HTTP Status: `200`

Content-Type: `application/json`

Field | Type | Description
--------- | :-----: | --------
`results` | object[] | Array of [Order Object](#order-object)
`item_count` | int | Total number of available orders matching criteria

### Example request

```bash
curl -X GET
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
                    "requestPrice": 5.79,
                    "isPreorder": true,
                    "releaseDate": "2020-10-07",
                    "keyType": "text",
                    "accurate": true,
                    "broker": "internal"
                }
            ],
            "isPreorder": true,
            "preorderReleaseDate": "2020-10-07"
        }
    ],
    "item_count": 1
}
```

## Order Statuses

Status | Description
------ | -------------
`processing` | Order awaits dispatch
`completed` | Order is completed, keys can be downloaded
