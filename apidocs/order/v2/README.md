# Order

Version: `v2`

## Table of Contents
- [Dispatch order](#dispatch-order)
- [Get order keys](#get-order-keys)


## Dispatch order

`POST /{version}/order/{orderId}/dispatch`

- `orderId` is a value returned by `/order` request

**Request Payload**

No payload required.

**Response**

HTTP Status 201
```
{
    "dispatchId": [int]
}
```

### Example
```
curl -X POST
     -H 'api-ecommerce-auth: ...' \
     -H 'Content-Type: application/json' \
     https://api2.kinguin.net/integration/v2/order/20549751/dispatch

```

### Example response
```
{
    "dispatchId": 14169762
}
```

## Get order keys

`GET /{version}/order/{orderId}/keys`

- `orderId` is a value returned by `/order` request

**Response**

HTTP Status 200
```
[
    {
        "serial": [string],
        "type": [string],
        "name": [string],
        "kinguinId": [integer],
        "offerId": [string]
    },
    (...)
]
```

`name` is product name

`type` can be `text/plain` or `image/jpeg`, `image/png`, `image/gif`

`serial` is a plain text serial key or in case of `image/*` base64 encoded content of the image with product serial key

`kinguinId` is product id (only available for orders created after 2018-11-13)

`offerId` is an offer id for given product

### Example
```
curl -X GET
     -H 'api-ecommerce-auth: ...' \
     -H 'Content-Type: application/json' \
     https://api2.kinguin.net/integration/v1/order/20549751/keys
```

### Example response
```
[
    {
        "serial": "0ddbebb2-559d-42e9-a8e1-fd4b2bdea858",
        "type": "text/plain",
        "name": "Anno",
        "kinguinId": 4,
        "offerId": "602"
    },
    {
        "serial": "/9j/4AAQSkZJRgABAQEAYABgAAD//gATQ3JlYXRlZCB3aXRoIEdJTVD/2wBDAFA3PEY8MlBGQUZaVVBfeMiCeG5uePWvuZHI////////////////////////////////////////////////////wAALCAASABABAREA/8QAHwAAAQUBAQEBAQEAAAAAAAAAAAECAwQFBgcICQoL/8QAtRAAAgEDAwIEAwUFBAQAAAF9AQIDAAQRBRIhMUEGE1FhByJxFDKBkaEII0KxwRVS0fAkM2JyggkKFhcYGRolJicoKSo0NTY3ODk6Q0RFRkdISUpTVFVWV1hZWmNkZWZnaGlqc3R1dnd4eXqDhIWGh4iJipKTlJWWl5iZmqKjpKWmp6ipqrKztLW2t7i5usLDxMXGx8jJytLT1NXW19jZ2uHi4+Tl5ufo6erx8vP09fb3+Pn6/9oACAEBAAA/AJo0iEMZZFywH8PU4pWjjV1Hlptbj7o60sWfIjAGcqM89OKGUBkUEnndyc06H/UR/wC6P5U6v//Z",
        "type": "image/jpeg",
        "name": "Aliens",
        "kinguinId": 409,
        "offerId": "603"
    }
]
```
