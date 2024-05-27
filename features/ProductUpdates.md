# How to keep products up to date

1. Register [webhooks](Webhooks.md)
2. Interval updates

```bash
    curl -H "X-Api-Key: [api-key]" -G --data-urlencode "updatedSince=[time-of-your-last-update]" https://gateway.kinguin.net/esa/api/v1/products
```