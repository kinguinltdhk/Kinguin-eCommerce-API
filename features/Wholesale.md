# Wholesale

### Guidelines

1. The `offerId` field is required when creating the order.
2. The maximum offer quantity for wholesale orders is `1000`.
3. The maximum total quantity for order is `1000`.
4. When `offers.wholesale.enabled` = false then buying more than `9` quantity is disabled.
5. Use pagination when downloading the keys.

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
|:-------:|:----:|
|    1    | 10+  |  
|    2    | 50+  |  
|    3    | 100+ | 
|    4    | 500+ | 

3. Create an order request

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
