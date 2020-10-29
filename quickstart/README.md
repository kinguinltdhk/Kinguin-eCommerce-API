# Quick start

- [Apply](#apply)
- [Create store](#create-store)
- [Search products](#search-products)
- [Place order](#place-order)
- [Dispatch](#dispatch)
- [Get keys](#get-keys)


## Apply

First go to https://www.kinguin.net/integration and apply for an eCommerce API account.

If you don't have Kinguin ID account yet register new account.


## Create store

We'll inform you when your application is accepted.

Sign in on Dashboard and add store in "My Stores" section.

After store is verified you can find there API key you should use to [authorize](../api/README.md#authorization) HTTP request.

**Keep your API key secret!**

> Remember that credentials on SANDBOX environment are different.

## Search Products

[Search Products](../api/products/v1/README.md#search-products) you want to offer to your customers.

```bash
curl -X POST
     -H 'X-Api-Key: [api-key]' \
     -H 'Content-Type: application/json' \
     https://gateway.kinguin.net/esa/api/v1/products?limit=10
```

## Place Order

[Place Order](../api/order/v1/README.md#place-order) with selected products.

```bash
curl -X POST
     -H 'X-Api-Key: [api-key]' \
     -H 'Content-Type: application/json' \
     -d '{"products":[{"kinguinId":1949,"qty":1,"name":"Counter-Strike: Source Steam CD Key","price":5.79"}]}' \
     https://gateway.kinguin.net/esa/api/v1/order
```

## Dispatch

After creating order you need to [dispatch](../api/order/v2/README.md#dispatch) it.

```bash
curl -X GET
     -H 'X-Api-Key: [api-key]' \
     https://gateway.kinguin.net/esa/api/v2/order/PHS84FJAG5U/dispatch
```

## Get Keys

After dispatching you can [Get Keys](../api/order/v2/README.md#get-keys).

```bash
curl -X POST
    -H 'X-Api-Key: [api-key]' \
     https://gateway.kinguin.net/esa/api/v2/order/PHS84FJAG5U/keys
```
