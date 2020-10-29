# How to buy specific offer

1. Contact with our business manager and ask for permissions.
2. After permissions was granted you will able to use product `offers`, `offersCount`, `totalQty` fields.
3. Set `offerId` parameter for the product for which you want to select an offer.
4. The `offerId` parameter should be unique (you can't buy same offer in the different configuration).

### Example request

```bash
curl -X POST
     -H 'X-Api-Key: [api-key]' \
     -H 'Content-Type: application/json' \
     -d '{"products":[{"kinguinId":1949,"qty":1,"name":"Counter-Strike: Source Steam CD Key","price":5.79,"offerId":"5f7efe3b369b4a0001c5b46f"}]}' \
     https://gateway.kinguin.net/esa/api/v1/order
```
