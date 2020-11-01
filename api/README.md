# API documentation

Version: `v1`

## Table of Contents

- [Products `v1`](products/v1/README.md)
- [Products `v2`](products/v2/README.md)
- [Orders `v1`](order/v1/README.md)
- [Orders `v2`](order/v2/README.md)
- [Balance](balance/v1/README.md)
- [Errors Codes](ErrorsCodes.md)

## Environment

**PRODUCTION**: https://api2.kinguin.net/integration or https://gateway.kinguin.net/esa/api (recommended)

> the `https://api2.kinguin.net/integration/v1` will be removed at end of the 2020.

**SANDBOX**: https://gateway.sandbox.kinguin.net/esa/api

## Authorization

Requests are authorized based on HTTP header `X-Api-Key` or `Api-Ecommerce-Auth`. You can find your API key in a Dashboard in **My Stores** section.

> We recommend to use `X-Api-Key` header.

### Example

```bash
curl -X POST
     -H 'X-Api-Key: [api-key]' \
     https://gateway.kinguin.net/esa/api/v1/products
```

> Remember that credentials on SANDBOX environment are different.

If invalid API key is being provided you can expect response in below format:

```json
{
  "kind": "Authorization",
  "status": 401,
  "detail": "Invalid authentication data.",
  "type": "Unauthorized"
}
```
