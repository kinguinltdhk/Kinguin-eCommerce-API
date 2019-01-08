# Postback notifications

- [Products updates notifications](#products-updates-notifications)
- [How to](#how-to)

# Products updates notifications

These notifications inform you when products price or stock level have been changed.

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

Notifications urls can be configured for each store.

Before enable **store postback notifications** you should verify you store (see store details in your Dashboard).

**Please keep in mind that your every notifications url should be placed into the same host name as your store url.**
