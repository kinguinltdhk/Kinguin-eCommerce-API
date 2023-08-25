# How to prevent order duplicates

In order request you can set `orderExternalId` field with your custom value.

That unique value prevents creating duplicate orders.

### Example request

```bash
curl -X POST \
     -H 'X-Api-Key: [api-key]' \
     -H 'Content-Type: application/json' \
     -d '{"products":[{"kinguinId":1949,"qty":1,"name":"Counter-Strike: Source Steam CD Key","price":5.79}],"orderExternalId":"ZETHAE8IVEIKU"}' \
     https://gateway.kinguin.net/esa/api/v1/order
```
