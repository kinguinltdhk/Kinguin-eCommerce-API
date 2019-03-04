# How to order pre-orders

**Requirements for ordering pre-orderes items**

1. Pre-order can't be ordered with other products types.
2. An order with a pre-order should have only one product item.
3. Pre-order's are dispatched automatically after the release date. Attempt to dispatch order before the release date will fail. To get `dispatchId` try to send [request for dispatch](../apidocs/order/README.md#dispatch-order) after release date.