# User

Version: `v1`

## Get balance

`GET /{version}/balance`

**Response**

HTTP Status 200
```
{
    "balance": [float]
}
```

### Example
```
curl -X GET
     -H 'api-ecommerce-auth: ...' \
     -H 'Content-Type: application/json' \
     https://api2.kinguin.net/integration/v1/balance
```

### Example response
```
{
    "balance": 123.45
}
```


