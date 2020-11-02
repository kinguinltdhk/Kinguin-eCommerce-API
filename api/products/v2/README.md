# Products API

Version: `v2`

## Table of Contents

- [Get product](#get-product)


## Get product

`GET /v2/products/{productId}`

### Input

Parameter | Type | Description
--------- | :-----: | -----------
`productId` | string | Another product ID

### Output

HTTP Status: `200`

Content-Type: `application/json`

Returns the [Product Object](../v1/README.md#product-object)

#### Example request

```bash
curl -X GET \
     -H 'X-Api-Key: [api-key]' \
     https://gateway.kinguin.net/esa/api/v2/products/5c9b5f6b2539a4e8f172916a
```

Worth to read:

- [How to keep products up to date](../../../features/ProductUpdates.md)
