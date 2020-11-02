# Quick start

- [Apply for access](#apply-for-access)
- [Create store](#create-store)
- [Search products](#search-products)
- [Place order](#place-order)
- [Dispatch](#dispatch)
- [Get keys](#get-keys)


## Apply for access

First go to [Kinguin Integration](https://www.kinguin.net/integration) and apply for the **Kinguin Api E-Commerce** account.

Before apply you must to have registered and accepted Kinguin ID account.


## Create store

We'll inform you when your application is accepted.

Sign in on Dashboard and add store in **My Stores** section.

After you verify the store, store API key will be generated and you can use it to [authorize](../api/README.md#authorization) HTTP requests.

> Keep your API key secret! Remember that credentials on SANDBOX environment are different.

## Search products

[Search products](../api/products/v1/README.md#search-products) you want to offer to your customers.

```bash
curl -X GET \
     -H 'X-Api-Key: [api-key]' \
     https://gateway.kinguin.net/esa/api/v1/products?name=forza
```

Worth to read:

- [How to keep products up to date](../features/ProductUpdates.md)

## Place order

[Place order](../api/order/v1/README.md#place-order) with selected products.

```bash
curl -X POST \
     -H 'X-Api-Key: [api-key]' \
     -H 'Content-Type: application/json' \
     -d '{"products":[{"kinguinId":1949,"qty":1,"name":"Counter-Strike: Source Steam CD Key","price":5.79"}]}' \
     https://gateway.kinguin.net/esa/api/v1/order
```

Worth to read:

- [How to buy specific offer](../features/BuyOffer.md)
- [How to buy text serial](../features/KeyType.md)
- [How to use coupon code](../features/CouponCode.md)
- [How to set custom order ID](../features/OrderExternalId.md)

## Dispatch

After creating order you need to [dispatch](../api/order/v2/README.md#dispatch) it.

```bash
curl -X GET \
     -H 'X-Api-Key: [api-key]' \
     https://gateway.kinguin.net/esa/api/v2/order/PHS84FJAG5U/dispatch
```

Worth to read:

- [How to dispatch order](../features/Dispatch.md)
- [How to buy PRE-ORDER](../features/PRE-ORDER.md)

## Get keys

After dispatching you can [get keys](../api/order/v2/README.md#get-keys).

```bash
curl -X GET \
     -H 'X-Api-Key: [api-key]' \
     https://gateway.kinguin.net/esa/api/v2/order/PHS84FJAG5U/keys
```
