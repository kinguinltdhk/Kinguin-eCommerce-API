# API Documentation

Version: `v1`

Base URL: https://api2.kinguin.net/integration

Base URL sandbox: https://api.api-sandbox.kinguin.info/integration

## Authorization

Requests are authorized based on HTTP header `api-ecommerce-auth`. You can find your access key in a Dashboard in "My Stores" section.

Example:
```
curl -H 'api-ecommerce-auth: abcdefghijkl1234567890' ...
```

**Remember that credentials on sandbox environment are different.**

If invalid key is provided you can expect:

HTTP 403 Forbidden  
```
{
    "error": "Access to this API has been disallowed"
}
```


## [Products](products/README.md)

## [Order V1](order/README.md)

## [Order V2](order/v2/README.md)

## [User](user/README.md)

## [Errors Codes](ErrorsCodes.md)
