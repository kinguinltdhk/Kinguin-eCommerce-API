# Quick start

- [How to get API key](#how-to-get-api-key)
- [Search products](#search-products)
- [Place order](#place-order)
- [Dispatch](#dispatch)
- [Get keys](#get-keys)


## How to get API key

1. Go to [Kinguin Integration](https://www.kinguin.net/integration) and click **APPLY FOR ACCESS** button.
2. If you don't have yet **Kinguin ID** account, please create it before.
3. Submit application form and wait for our approval. If you're active Kinguin Seller your application will be automatically approved. You will be notified by e-mail when your application become approved.
4. After positive verification of your application you can go to your [Dashboard](https://www.kinguin.net/integration/dashboard).
5. Go to **MY STORES** section and click on **ADD STORE** button in top right corner. Fill form with your first store's data and verify it by choosing from two available options.
6. After your store has been verified the **API key** will be generated.
7. Register endpoints for [postback notifications](../features/Postback.md).

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
     -d '{"products":[{"kinguinId":1949,"qty":1,"name":"Counter-Strike: Source Steam CD Key","price":5.79}]}' \
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
