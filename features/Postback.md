# Postback notifications

- [Products updates notifications](#products-updates-notifications)
- [How to](#how-to)


# Products updates notifications

These notifications inform you about changes in products price or stock level.

### Payload

Each product update notification is an `application/json` message sending by `POST` request:

```
{
   "kinguinId": [integer],
   "updatedAt": [string]
}
```

Where `kinguinId` is an id of updated product and `updatedAt` is a date of update.

### Response

For each postback notification your endpoint should respond with status `200`.

After first bad response we will try to resend notification a couple of times.


# How to

Notification url should be configured per store.

Before enable **store postback notifications** you should verify you store (see store details in your Dashboard).

**Please keep in mind that every notification url should be placed into the same host name as store url.**
