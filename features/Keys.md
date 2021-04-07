# How to load keys

We are triggering a set of webhooks when all purchased keys are ready to download.

The `order.complete` and `order.status` webhooks will be sent. In case of `order.status` webhook the `status` property should be equal to `completed`.

More info about webhooks logic you can find [here](Webhooks.md).

Finally, to load keys use [Get Keys](../api/order/v2/README.md#get-keys) endpoint.


## Backoff strategy

In a situation where the webhook has not been received by you or has not arrived, it is recommended to prepare a solution that will periodically ask the API about the status of the order.

When status is `completed` then you can load keys.


## Loading keys for pre-order

In case of pre-order the webhooks are triggered only after `releaseDate`. So there is no need to ask for keys earlier than this date.
