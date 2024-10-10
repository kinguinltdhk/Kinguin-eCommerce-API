# Wholesale

### Guidelines

1. The `offerId` property is required when creating an order.
2. The maximum offer quantity is `1000`.
3. The maximum total order quantity is `1000`.
4. Wholesale is enabled only for offers with `wholesale.enabled` property equals to `true` and with ordered quantity greater than `9`.
5. Use pagination when downloading keys for wholesale when order total quantity is greater than `100`.

### How to buy wholesale

1. Get product details and find an offer with `wholesale.enabled` = true.
```json
{
  "offers": [
    {
      "name": "Counter-Strike: Source Steam CD Key",
      "offerId": "5f7efe3b369b4a0001c5b46f",
      "price": 5.79,
      "qty": 149,
      "textQty": 149,
      "merchantName": "KinguinHK",
      "releaseDate": "2004-11-01",
      "wholesale": {
        "enabled": true,
        "tiers": [
          {
            "level": 1,
            "price": 5.5
          },
          {
            "level": 2,
            "price": 5.4
          },
          {
            "level": 3,
            "price": 5.3
          },
          {
            "level": 4,
            "price": 5.2
          }
        ]
      }
    }
  ]
}

```
2. Pick the valid price according to the ordered quantity.

|  Level  | Qty  |
|:-------:|:-----|
|    1    | 10+  |  
|    2    | 50+  |  
|    3    | 100+ | 
|    4    | 500+ | 

3. Create an order.

```json
{
  "products": [
    {
      "kinguinId": 1949,
      "qty": 50,
      "price": 5.4,
      "offerId": "5f7efe3b369b4a0001c5b46f"
    }
  ]
}
```
