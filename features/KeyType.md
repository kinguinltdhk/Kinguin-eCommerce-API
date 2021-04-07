# How to buy text keys

1. [Manual select a key type](#manual-select-a-key-type)
2. [Show and buy only products with text keys](#show-and-buy-only-products-with-text-keys)

## Manual select a key type

1. Check if a given product or offer has stock with `text` keys. In that case you should check `textQty` property - it should be greater than zero.
2. Next, you have to set `products.keyType` property with `text` value.

### Requirements

Ask your business manager for permissions when `textQty` property is not available in [Product Object](../api/products/v1/README.md#product-object). 

### Example request

```bash
curl -X POST \
     -H 'X-Api-Key: [api-key]' \
     -H 'Content-Type: application/json' \
     -d '{"products":[{"kinguinId":1949,"qty":1,"name":"Counter-Strike: Source Steam CD Key","price":5.79,"keyType":"text"}]}' \
     https://gateway.kinguin.net/esa/api/v1/order
```

### Key types

| Type
| ----------------------
| `text`


## Show and buy only products with text keys

1. Ask your business manager for permissions.
2. After permissions was granted all offers with images will be filtered for you by default.
3. You don't to have set `products.keyType`.