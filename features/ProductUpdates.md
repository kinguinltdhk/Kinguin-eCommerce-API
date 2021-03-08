# How to keep products up to date

1. Register [webhooks](Webhooks.md)
2. Interval updates

    ```bash
    curl -H "X-Api-Key: [api-key]" -G --data-urlencode "updatedSince=[time-of-your-last-update]" https://gateway.kinguin.net/esa/api/v1/products
    ```

3. Parse [Error Object](../api/ErrorsCodes.md). When `kind` field is `ProductUnavailable` then wait for a while, try to update a product and retry place order request. If error response will be the same then omit the request, the product is probably unavailable.
