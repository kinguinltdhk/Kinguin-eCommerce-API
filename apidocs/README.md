# API Documentation

Version: `v1`

Base URL: https://api2.kinguin.net/integration

Base URL sandbox: https://api-sandbox.kinguin.info/integration

## Authorization

Requests are authorized based on HTTP header `api-ecommerce-auth`. You can find your access key in a Dashboard in "My Stores" section.

Example:
```
curl -H 'api-ecommerce-auth: abcdefghijkl1234567890' ...
```

**Remember that credentials on sandbox environment are different.**

## [Products](products/README.md)

## [Order](order/README.md)

## [User](user/README.md)
