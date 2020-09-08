# How to select key type

1. Contact with our business manager and ask for permissions.
2. After permissions was granted you will able to use product `textQty`, `imageQty` parameters and `onlyText` filter.
3. Set `keyType` parameter for each product you want to order.

## Example
```
curl -X POST
     -H 'api-ecommerce-auth: ...' \
     -H 'Content-Type: application/json' \
     -d '{"products":[{"kinguinId":5,"qty":1,"name":"Anno","price":3.59,"keyType":"text"}]}' \
     https://api2.kinguin.net/integration/v1/order
```

List of available key types:

* `text`
