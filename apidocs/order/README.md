# Order

Version: `v1`

## Table of Contents
- [Place order](#place-order)
- [Dispatch order](#dispatch-order)
- [Get order keys](#get-order-keys)
- [Get order](#get-order)
- [Get orders](#get-orders)
- [Order object](#order-object)
- [Order statuses](#order-statuses)

## Place order

`POST /{version}/order`

**Request Payload**

```
{
    "products": [
        {
            "kinguinId": [integer],
            "qty": [integer],
            "price": [float],
            "name"*: [string]
        },
        (...)
    ] 
}
```
`* optional field`

**Response**

HTTP Status 201
```
{
    "orderId": [string]
}
```

In case of error HTTP Status other then 2xx is return and [error object](../ErrorsCodes.md) containing code and message

### Example
```
curl -X POST
     -H 'api-ecommerce-auth: ...' \
     -H 'Content-Type: application/json' \
     -d '{"products":[{"kinguinId":5,"qty":1,"name":"Anno","price":3.59}, {"kinguinId":8,"qty":1,"name":"Aliens","price":4.99}]}' \
     https://api2.kinguin.net/integration/v1/order
```

### Example response
```
{
    "orderId": "20549751"
}
```


## Dispatch order

`POST /{version}/order/dispatch`

**Request Payload**

```
{
    "orderId": [string]
}
```
`orderId` is a value returned by `/order` request

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
     -d '{"orderId": "20549751"}' \
     https://api2.kinguin.net/integration/v1/order/dispatch

```

### Example response
```
{
    "dispatchId": 14169762
}
```



## Get order keys

`GET /{version}/order/dispatch/keys?dispatchId={dispatchId}`

`dispatchId` is a value returned by `/order/dispatch` request

**Response**

HTTP Status 200
```
[
    {
        "serial": [string],
        "type": [string],
        "name": [string],
        "kinguinId": [integer]
    },
    (...)
]
```

`name` is product name

`type` can be `text/plain` or `image/jpeg`, `image/png`, `image/gif`

`serial` is a plain text serial key or in case of `image/*` base64 encoded content of the image with product serial key

`kinguinId` is product id (only available for orders created after 2018-11-13)

### Example
```
curl -X GET
     -H 'api-ecommerce-auth: ...' \
     -H 'Content-Type: application/json' \
     https://api2.kinguin.net/integration/v1/order/dispatch/keys?dispatchId=14169762
```

### Example response
```
[
    {
        "serial": "0ddbebb2-559d-42e9-a8e1-fd4b2bdea858",
        "type": "text/plain",
        "name": "Anno",
        "kinguinId": 4
    },
    {
        "serial": "/9j/4AAQSkZJRgABAQEAYABgAAD//gATQ3JlYXRlZCB3aXRoIEdJTVD/2wBDAFA3PEY8MlBGQUZaVVBfeMiCeG5uePWvuZHI////////////////////////////////////////////////////wAALCAASABABAREA/8QAHwAAAQUBAQEBAQEAAAAAAAAAAAECAwQFBgcICQoL/8QAtRAAAgEDAwIEAwUFBAQAAAF9AQIDAAQRBRIhMUEGE1FhByJxFDKBkaEII0KxwRVS0fAkM2JyggkKFhcYGRolJicoKSo0NTY3ODk6Q0RFRkdISUpTVFVWV1hZWmNkZWZnaGlqc3R1dnd4eXqDhIWGh4iJipKTlJWWl5iZmqKjpKWmp6ipqrKztLW2t7i5usLDxMXGx8jJytLT1NXW19jZ2uHi4+Tl5ufo6erx8vP09fb3+Pn6/9oACAEBAAA/AJo0iEMZZFywH8PU4pWjjV1Hlptbj7o60sWfIjAGcqM89OKGUBkUEnndyc06H/UR/wC6P5U6v//Z",
        "type": "image/jpeg",
        "name": "Aliens",
        "kinguinId": 409
    }
]
```


## Get order

`GET /{version}/order/{orderId}`

`orderId` is a value returned by POST `/order` request (only with status other than "error")

**Response**

HTTP Status 200
```
{
    "totalPrice": [float],
    "orderId": [string],
    "status": [string],
    "storeId": [int],
    "createdAt": [string],
    "products": [
        {
            "kinguinId": [int],
            "qty": [int],
            "name": [string],
            "price": [float]
        },
        (...)
    ],
    "dispatch": {
        "dispatchId": [int],
        "createdAt": [string]
    }
}
```

**check available [order statuses](#order-statuses)**

### Example
```
curl -X GET
     -H 'api-ecommerce-auth: ...' \
     -H 'Content-Type: application/json' \
     https://api2.kinguin.net/integration/v1/order/20549751
```

### Example response
```
{
    "totalPrice": 8.58,
    "orderId": "20549751",
    "status": "completed",
    "storeId": 1,
    "createdAt": "2018-10-31T11:31:13+00:00",
    "products": [
        {
            "kinguinId": 5,
            "qty": 1,
            "name": "Anno",
            "price": 3.59
        },
        {
            "kinguinId": 8,
            "qty": 1,
            "name": "Alien",
            "price": 4.99
        }
    ],
    "dispatch": {
        "dispatchId": 14169762,
        "createdAt": "2018-10-31T11:34:25+00:00"
    }
}
```

## Get orders

`GET /{version}/order`

### Input

Parameter | Type | Required | Description
--------- | -----| :--------: | -----------
page | int | - | Page number
limit | int | - | Limit results (default: `10`, maximum: `100`)
sortBy | string | - | Sort field name (default: `createdAt`, values: `totalPrice`, `status` or `createdAt`)
sortType | string | - | Sort type (default: `desc`, values: `asc` or `desc`)
totalPriceFrom | float | - | Total price from
totalPriceTo | float | - | Total price to
createdAtFrom | string | - | UTC date
createdAtTo | string | - | UTC date
kinguinId | int | - | Product id
name | string | - | Product name
status | string | - | Comma separated list of [order statuses](#order-statuses)

### Output

Parameter | Type | Description
--------- | -----| --------
results | array-object | Array of [Order Object](#order-object)
item_count | int | Total number of available orders matching filters

**Response**

HTTP Status 200
```
{
    "results": [
        {
            "totalPrice": [float],
            "orderId": [string],
            "status": [string],
            "storeId": [int],
            "createdAt": [string],
            "products": [
                {
                    "kinguinId": [int],
                    "qty": [int],
                    "name": [string],
                    "price": [float]
                },
                (...)
            ],
            "dispatch": {
                "dispatchId": [int],
                "createdAt": [string]
            }
        },
        (...)
    ],
    "item_count": [int]
}
```

**check available [order statuses](#order-statuses)**

### Example
```
curl -X GET
     -H 'api-ecommerce-auth: ...' \
     -H 'Content-Type: application/json' \
     https://api2.kinguin.net/integration/v1/order?totalPriceFrom=4&totalPriceTo=15&limit=2&status=completed,error
```

### Example response
```
{
    {
    "results": [
        {
            "totalPrice": 13.5,
            "status": "error",
            "storeId": 1,
            "createdAt": "2018-11-13T11:05:30+00:00",
            "products": [
                {
                    "kinguinId": 18,
                    "qty": 1,
                    "product_id": 367,
                    "price": 13.5,
                    "name": "Battlefield 3 Close Quarters Expansion Pack DLC"
                }
            ]
        },
        {
            "totalPrice": 13.5,
            "orderId": "17461",
            "status": "completed",
            "storeId": 1,
            "createdAt": "2018-11-13T10:26:56+00:00",
            "products": [
                {
                    "kinguinId": 18,
                    "qty": 1,
                    "product_id": 367,
                    "price": 13.5,
                    "name": "Battlefield 3 Close Quarters Expansion Pack DLC"
                }
            ],
            "dispatch": {
                "dispatchId": 10352,
                "createdAt": "2018-11-13T10:27:19+00:00"
            }
        }
    ],
    "item_count": 2
}
```

## Order Object

Field | Type | Description
--------- | -----| --------
totalPrice | float | Total price
orderId`*` | string | Order id
status | string | Status
storeId | int | Store id
createdAt | string | UTC date
products | array | Products list
dispatch`*` | array | Dispatch id and date of create

`* optional attribute`

## Order Statuses

Status | Description
------ | -------------
pending | Order is being processed
processing | Order awaits dispatch
completed | Order is completed, keys can be downloaded
out_of_stock | Out of requested quantity with given price
error | There was an unrecoverable error in processing order request
