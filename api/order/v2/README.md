# Orders API

Version: `v2`

## Table of Contents

- [Place order](#place-order)
- [Dispatch](#dispatch)
- [Get keys](#get-keys)
- [Key object](../v1/README.md#key-object)

## Place order

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

Field | Type | Description
--------- | :-----: | --------
`products.productId` | string | Another product ID
`products.qty` | int | Ordered quantity (max: `100`)
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

Returns the [Order Object](../v1/README.md#order-object)

### Example request

```bash
curl -X POST \
     -H 'X-Api-Key: [api-key]' \
     -H 'Content-Type: application/json' \
     -d '{"products":[{"productId":"5c9b68662539a4e8f17ae2fe","qty":1,"name":"Counter-Strike: Source Steam CD Key","price":5.79}]}' \
     https://gateway.kinguin.net/esa/api/v2/order
```

Worth to read:

- [How to buy specific offer](../../../features/BuyOffer.md)
- [How to buy text serial](../../../features/KeyType.md)
- [How to use coupon code](../../../features/CouponCode.md)
- [How to set custom order ID](../../../features/OrderExternalId.md)



## Dispatch

`POST /v2/order/{orderId}/dispatch`

### Input

Content-Type: No payload required.

Parameter | Type | Description
--------- | :-----: | -----------
`orderId` | string | Order ID

### Output

HTTP Status: `201`

Content-Type: `application/json`

```json
{
    "dispatchId": [int]
}
```

### Example request

```bash
curl -X POST \
     -H 'X-Api-Key: [api-key]' \
     -H 'Content-Type: application/json' \
     https://gateway.kinguin.net/esa/api/v2/order/PHS84FJAG5U/dispatch
```

Worth to read:

- [How to dispatch order](../../../features/Dispatch.md)
- [How to buy PRE-ORDER](../../../features/PRE-ORDER.md)



## Get keys

`GET /v2/order/{orderId}/keys`

### Input

Parameter | Type | Description
--------- | :-----: | -----------
`orderId` | string | Order ID

### Output

HTTP Status: `200`

Content-Type: `application/json`

Returns the array of [Key Object](../v1/README.md#key-object)

### Example request

```bash
curl -X GET \
     -H 'X-Api-Key: [api-key]' \
     https://gateway.kinguin.net/esa/api/v2/order/PHS84FJAG5U/keys
```
