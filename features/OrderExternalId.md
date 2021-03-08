# How to set custom order ID

In order request sent `orderExternalId` field with your custom value.

It prevents before creating duplicates in your account.

The value of `orderExternalId` property should be unique across your account.

### Example request

```bash
curl -X POST \
     -H 'X-Api-Key: [api-key]' \
     -H 'Content-Type: application/json' \
     -d '{"products":[{"kinguinId":1949,"qty":1,"name":"Counter-Strike: Source Steam CD Key","price":5.79}],"orderExternalId":"ZETHAE8IVEIKU"}' \
     https://gateway.kinguin.net/esa/api/v1/order
```
