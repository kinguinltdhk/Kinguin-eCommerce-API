# How to load keys

We are triggering a set of webhooks when all purchased keys are ready to download.

The `order.complete` and `order.status` webhooks will be sent. In means that order became `completed`.

More info about webhooks you can find [here](Webhooks.md).

Finally, to load keys use [Get Keys](../api/order/v2/README.md#get-keys) endpoint.


## Backoff strategy

In a situation where the webhook has not been received by you or has not arrived, it is recommended to prepare a solution that will periodically ask the API about the status of the order.

When order is `completed` then you can load keys.


## Loading keys for pre-orders

In case of pre-orders the webhook is triggered only after `releaseDate`. So there is no need to ask for keys earlier than this date.
