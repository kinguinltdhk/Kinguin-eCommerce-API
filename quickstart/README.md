# Quick start

- [How to get API key](#how-to-get-api-key)
- [Search products](#search-products)
- [Place order](#place-an-order)
- [Download keys](#download-keys)


## How to get API key

1. Go to [Kinguin Integration](https://www.kinguin.net/integration) and click **APPLY FOR ACCESS** button.
2. If you don't have **Kinguin ID** account, please create it before.
3. Submit application request and wait for our approval. If you're an active Kinguin Seller your application will be automatically approved. You will be notified by e-mail when your application become approved.
4. Once your request has been approved you will be able to configure your first store [Dashboard](https://www.kinguin.net/integration/dashboard/stores).

> Keep your API key secret! Remember that credentials on SANDBOX environment are different.

> Your Kinguin ID account should have configured a default billing address - it is required to place order through our API.

## Search products

[Search products](../api/products/v1/README.md#search-products) you want to offer to your customers.

```bash
curl -X GET \
     -H 'X-Api-Key: [api-key]' \
     https://gateway.kinguin.net/esa/api/v1/products
```

Also read:

- [How to keep products up to date](../features/ProductUpdates.md)

## Register webhooks

[Register webhooks](../features/Webhooks.md) to be informed about order status changes.

## Place an order

[Place an order](../api/order/v2/README.md#place-an-order) with selected products.

```bash
curl -X POST \
     -H 'X-Api-Key: [api-key]' \
     -H 'Content-Type: application/json' \
     -d '{"products":[{"productId":"5c9b68662539a4e8f17ae2fe","qty":1,"price":5.79}]}' \
     https://gateway.kinguin.net/esa/api/v2/order
```

## Download keys

Download keys once they have been delivered [Download Keys](../api/order/v2/README.md#download-keys).

```bash
curl -X GET \
     -H 'X-Api-Key: [api-key]' \
     https://gateway.kinguin.net/esa/api/v2/order/PHS84FJAG5U/keys
```
