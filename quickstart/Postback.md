# Postback notifications

- [Products updates notifications](#products-updates-notifications)
- [How to](#how-to)

# Products updates notifications

These notifications inform you about changes in products price or stock level.

### Payload

```
{
   "kinguinId": [integer],
   "updatedAt": [string]
}
```

### Response

After every response code from your notification endpoint different than `200` we will try to resend notification a couple of times.


# How to

Notification url can be configured for each store.

Before enable **store postback notifications** you should verify you store (see store details in your Dashboard).

**Please keep in mind that every notification url should be placed into the same host name as store url.**
