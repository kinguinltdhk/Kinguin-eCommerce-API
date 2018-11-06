# Quick start

- [Apply](#apply)
- [Create store](#create-store)
- [List products](#list-products)
- [Place order](#place-order)
- [Dispatch order](#dispatch-order)
- [Get serial keys](#get-serial-keys)


## Apply

First go to https://www.kinguin.net/integration/ and apply for an eCommerce API account.

If you don't have Kinguin ID account yet register new account.


## Create store

We'll inform you when your application is accepted.

Sign in on Dashboard and add store in "My Stores" section.

After store is verified you can find there API KEY you should use to [authorize](../apidocs/README.md#authorization) HTTP request.

`Keep your API KEY secret !!!`

**Remember that credentials on sandbox environment are different.**

## List products

[List, search, filter products](../apidocs/products/README.md#list-products) you want to offer to your customers.
```
curl -H 'api-ecommerce-auth: ...' \
     -H 'Content-Type: application/json' \
     https://api2.kinguin.net/integration/v1/products?limit=10
```

## Place order

[Place order](../apidocs/order/README.md#place-order) with selected products.
```
curl -X POST
     -H 'api-ecommerce-auth: ...' \
     -H 'Content-Type: application/json' \
     -d '{"products":[{"kinguinId":5,"qty":1,"name":"Anno","price":3.59}, {"kinguinId":8,"qty":1,"name":"Aliens","price":4.99}]}' \
     https://api2.kinguin.net/integration/v1/order
```

## Dispatch order

After creating order you need to [dispatch](../apidocs/order/README.md#dispatch-order) it.
```
curl -X POST
     -H 'api-ecommerce-auth: ...' \
     -H 'Content-Type: application/json' \
     -d '{"orderId": "20549751"}' \
     https://api2.kinguin.net/integration/v1/order/dispatch

```

## Get serial keys

After dispatching you can [get serial keys](../apidocs/order/README.md#get-order-keys).
```
curl -X GET
     -H 'api-ecommerce-auth: ...' \
     -H 'Content-Type: application/json' \
     https://api2.kinguin.net/integration/v1/order/dispatch/keys?dispatchId=14169762
```
