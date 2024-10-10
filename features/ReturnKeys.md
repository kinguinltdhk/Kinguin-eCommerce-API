# Return keys

### Limitations

The return is not allowed, when:

1. The key has been claimed.
2. The order contains at least 1 wholesale item.
3. 24 hours have passed since the key was delivered.
4. Pre-order.

You can send only **one** request for return keys for given order.

### How to

Use this endpoint [Return Keys](../api/order/v2/README.md#return-keys) and send a request.
All keys meeting requirements will be returned and refunded during processing request.
In case of delay in delivering keys, the return will be executed separately once key will be delivered.