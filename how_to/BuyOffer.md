# How to buy selected offer

1. Contact with our business manager and ask for permissions.
2. After permissions was granted you will able to use product `offers`, `offersCount`, `totalQty` parameters and `vendorName` filter.
3. Set `offerId` parameter for the product for which you want to select an offer.
4. The `offerId` parameter should be unique (you can't order same offer in different configuration).

## Example
```
curl -X POST
     -H 'api-ecommerce-auth: ...' \
     -H 'Content-Type: application/json' \
     -d '{"products":[{"kinguinId":5,"qty":1,"name":"Anno","price":3.59,"offerId":"92"}]}' \
     https://api2.kinguin.net/integration/v1/order
```
