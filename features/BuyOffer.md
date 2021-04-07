# How to buy specific offer

In addition to ordering only the cheapest offers, our API also allows you to purchase other offers - those that meet the more complex requirements of integrators.

In that case, just set `products.offerId` property in order request.

## Requirements

Ask your business manager for permissions when `offers` property is not available in [Product Object](../api/products/v1/README.md#product-object).

The `products.offerId` property must be unique in a single order request.

### Example request

```bash
curl -X POST \
     -H 'X-Api-Key: [api-key]' \
     -H 'Content-Type: application/json' \
     -d '{"products":[{"kinguinId":1949,"qty":1,"name":"Counter-Strike: Source Steam CD Key","price":5.79,"offerId":"5f7efe3b369b4a0001c5b46f"}]}' \
     https://gateway.kinguin.net/esa/api/v1/order
```
