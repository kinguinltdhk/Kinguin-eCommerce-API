# Changelog

## [2025-05-12]

### Removed
- api2.kinguin.net host
### Added
- countryLimitation property

## [2025-03-25]

### Removed
- removed order deprecated endpoints and properties
### Changed
- product videos schema updated

## [2024-10-10]

### Added
- endpoint for returning keys
- expose key statuses in order details response

## [2024-06-18]

### Added
- pagination for getting keys
- wholesale purchasing
- added `offers.availableQty` and `offers.availableTextQty` fields
### Changed
- quantity limit per offer is `9`
- max `10` unique items per order
- allow to getting keys during order processing
- all dispatch endpoints set as **DEPRECATED** (removed from documentation)
- getting keys by `dispatchId` field set as **DEPRECATED** (removed from documentation)
- sorting by `price` and `name` fields set as **DEPRECATED** (removed from documentation)
- filtering by `priceFrom` and `priceTo` fields set as **DEPRECATED** (removed from documentation)
- `order.complete` webhook set as **DEPRECATED** (removed from documentation)
- `retryable` field from error response set as **DEPRECATED** (removed from documentation)

## [2022-02-14]

### Added
- added `qty`, `textQty`, `price` and `cheapestProductId` to `product.update` event payload

## [2021-09-28]

### Added
- added `OrderNotSupported` error kind

## [2021-07-30]

### Added
- added `images` property to product object,
### Changed
- `coverImage`, `coverImageOriginal` and `screenshots` product properties set as **DEPRECATED** (`images` property should be used instead)

## [2021-04-07]

### Added
- possibility to show and buy only text keys
### Changed
- dispatch endpoint set as **DEPRECATED**, consider to use [webhooks](features/Webhooks.md)

## [2021-03-08]

### Added
- added `X-Event-Name` header to webhook,
- added `X-Event-Secret` header to webhook,
- added `order.status` webhook, [details here](features/Webhooks.md#order-status-changed-webhook)

## [2021-03-04]

### Added
- added `ageRating` field to product object,
- added `steam` field in product object,

## [2021-01-04]

### Added
- added `totalQty` field to order object,
- added `products.totalPrice` field in order object,

## [2020-11-16]

### Changed
- type of `orderId` and `offerId` fields transformed to `string`,
- error response format, [details here](api/ErrorsCodes.md)

### Added
- added `couponCode` field to order request payload
- added `orderExternalId` field to order request payload
- added `orderExternalId`, `kinguinOrderId` and `productId` filters for `/api/v1/order` endpoint,
- added `offerId`, `productId` fields to response from `/api/v1/order/dispatch/keys` endpoint,
- added `paymentPrice`, `requestTotalPrice`, `products.requestPrice`, `products.releaseDate`, `isPreorder`, `preorderReleaseDate`, `kinguinOrderId` fields to order object
- added `X-Api-Key` header as a replacement/alias for `Api-Ecommerce-Auth`,
- added `/api/v2/order` endpoint, [details here](api/order/v2/README.md#place-an-order)
- added `/api/v2/order/{orderId}/dispatch` endpoint
- added `/api/v2/order/{orderId}/keys` endpoint, [details here](api/order/v2/README.md#download-keys)
- added `/api/v2/products/{productId}` endpoint, [details here](api/products/v2/README.md#get-product)
- added multiple values search for `genre` and `platform` filters,
- added `merchantName` field to offer object,
- added `productId`, `merchantName`, `withText` filters for `/api/v1/products` endpoint,
- return [Order Object](api/order/v1/README.md#order-object) in place order response,
- send webhook after order dispatch
- added `productId` field to product update webhook,
- trigger product update webhooks after `releaseDate` field changed,

### Removed
- the `https://api2.kinguin.net/integration` will be removed at the end of the 2020, please switch to `https://gateway.kinguin.net/esa/api`,
- removed `preorderFromDate` (use `releaseDate` instead), `preorderToDate`, `imageQty`, `originScore`, `type`, `status` fields from product object,
- removed `type`, `vendorName`, `isCheapest`, `imageQty` fields from offer object,
- removed `vendorName` filter (use `merchantName` instead) from `/api/v1/products` endpoint,
- removed `steam gift` and `preorder` tags ,
- removed `image` choice from `keyType` field,

## [2019-12-10]

### Added
- possibility to select key type (`text` or `image`)
- possibility to buy selected offer
- added `vendorName` and `onlyText` filters to products, [details here](api/products/v1/README.md#search-products)
- added `textQty`, `imageQty` to product, [details here](api/products/v1/README.md#product-object)
- added `offers`, `offersCount`, `totalQty` to product, [details here](api/products/v1/README.md#offer-object)

### Removed
- removed `newsFromDate`, `newsToDate`, `stock` from product (was DEPRECATED before)

## [2019-03-27]

### Added
- min length validation for `name` filter, [details here](api/products/v1/README.md#search-products)

### Changed
- `kinguinId` filter accepts multiple `kinguinId` values, [details here](api/products/v1/README.md#search-products)
- `stock` field is **DEPRECATED** and will be removed, use `qty` field instead

### Removed
- removed `steamScore` from products fields
- removed `stock` filter

## [2019-02-28]

### Added
- added `isPreorder` filter to orders endpoint, [details here](api/order/v1/README.md#search-orders)
- added `isPreorder` to `order.products` collection, [details here](api/order/v1/README.md#search-orders)

## [2019-02-21]

### Added
- added `coverImageOriginal` to product, [details here](api/products/v1/README.md#product-object)
- added `genre` filter, [details here](api/products/v1/README.md#search-products)

### Changed
- updated products genres list, [details here](api/products/v1/README.md#genres)

## [2019-01-23]

### Added
- add `offerId` to `order.products` collection, [details here](api/order/v1/README.md#search-orders)

## [2019-01-09]

### Added
- webhooks for products updates, [details here](features/Webhooks.md#product-updated-webhook)

## [2018-11-20]

### Added
- new endpoint GET /order, [details here](api/order/v1/README.md#search-orders)

## [2018-11-14]
### Changed
- product `regionalLimitations` field now stores a *name of region* instead of url to icon
- fields such as `originalName`, `description`, `coverImage`, `screenshots`, `videos`, `developers`, `publishers` and `releaseDate` have become optional fields and may not be accessible for all products
- product `sortBy` field has been limited to `kingiunId`, `name`, `qty` and `price` values
- product `sortType` filed has been limited to `asc` and `desc`
  
### Added
- product `regionId` filed which stores id of *region name*, [details here](api/products/v1/README.md#regions)
- `originalName` field which stores base name of product
- `isPreorder` field
- `status` filed which indicates if offer is active and ready to buy at Kinguin platform. The valid product should have `active` status. *IMPORTANT: Products only with that status can be ordered at Kinguin platform*
- `type` field which stores the type of product. For now there is only one `serial` available value. *IMPORTANT: Only `serial` products will be exposed by Product Api*
- `systemRequirements` field which stores list of hardware requirements for the product
- `tags` field which stores list of product's tags, [details here](api/products/v1/README.md#tags)
- added `isPreorder` parameter to query filters (acceptable values are `yes` and `no`)
- added `activePreorder` parameter to query filters (acceptable value is `yes`). It checks only the date of preorder activity, so if you want get only active preorders just use both parameters `isPreorder=yes` and `activePreorder=yes`
- added `regionId` parameter to query filters
- added `tags` parameter to query filters. It should be comma separated list of tags
- added `updatedSince` and `updatedTo` parameters to query filters. Both should be a valid UTC date. It allows to filter products by last update date

## [2018-11-13]
### Changed
- improved [errors and messages](api/ErrorsCodes.md)

### Added
- `kinguinId` in order/dispatch/keys endpoint
