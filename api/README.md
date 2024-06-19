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

**PRODUCTION API**: https://gateway.kinguin.net/esa/api

**SANDBOX API**: https://gateway.sandbox.kinguin.net/esa/api

## How to create SANDBOX account

You can create SANDBOX account [here](https://sandbox.kinguin.net/integration) and get the API key analogical as on production. See [Quick start](../quickstart/README.md). 

After that, ask your business manager to fill your account with balance.

## Authorization

Authorization is based on HTTP header `X-Api-Key`. You can find your API key in a Dashboard in **MY STORES** section.

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
