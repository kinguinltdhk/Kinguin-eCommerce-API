# API Documentation

Version: `v1`

Base URL: https://api2.kinguin.net/integration

Base URL sandbox: https://api-sandbox.kinguin.info/integration

## Authorization

Requests are authorized based on HTTP header `api-ecommerce-auth`. You can find your access key in a Dashboard.

Example:
```
curl -H 'api-ecommerce-auth: abcdefghijkl1234567890' ...
```

## [Products](products/README.md)

## [Order](order/README.md)