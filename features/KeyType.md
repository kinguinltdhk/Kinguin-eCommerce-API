# How to buy text serial

1. Contact with our business manager and ask for permissions.
2. After permissions was granted you will able to use product `textQty` field and `withText` filter.
3. Set `keyType` parameter with `text` value for each text serial you want to buy.

### Example request

```bash
curl -X POST
     -H 'X-Api-Key: [api-key]' \
     -H 'Content-Type: application/json' \
     -d '{"products":[{"kinguinId":1949,"qty":1,"name":"Counter-Strike: Source Steam CD Key","price":5.79,"keyType":"text"}]}' \
     https://gateway.kinguin.net/esa/api/v1/order
```

## Key types

| Type
| ----------------------
| `text`
