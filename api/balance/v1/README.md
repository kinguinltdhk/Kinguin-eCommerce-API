# Balance API

Version: `v1`

## Table of Contents

- [Get Balance](#get-balance)

## Get Balance

`GET /v1/balance`

### Output

HTTP Status: `200`

Content-Type: `application/json`

```json
{
    "balance": [float]
}
```

Field | Type | Description
--------- | :-----: | --------
`balance` | float | Balance value

### Example request

```bash
curl -X GET
     -H 'X-Api-Key: [api-key]' \
     https://gateway.kinguin.net/esa/api/v1/balance
```

### Example response

```json
{
    "balance": 12.45
}
```
