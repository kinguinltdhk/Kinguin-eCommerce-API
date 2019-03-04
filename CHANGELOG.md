# Changelog

## Unreleased
- required to set minimum 3 characters to `name` parameter when querying products
- steam score attribute is going to be removed from products

## [2019-02-28]

### Added
- added `isPreorder` filter and to order responce, [details here](apidocs/order/README.md#get-orders)

## [2019-02-21]

### Added
- added `coverImageOriginal` to product, [details here](apidocs/products/README.md#product-object)
- added `genre` filter, [details here](apidocs/products/README.md#list-products)

### Changed
- updated products genres list, [details here](apidocs/products/README.md#genres)

## [2019-01-23]

### Added
- add `offerId` to `order.products` collection, [details here](apidocs/order/README.md#get-orders)

## [2019-01-09]

### Added
- postback notifications for products updates, [details here](features/Postback.md#products-updates-notifications)

## [2018-11-20]

### Added
- new endpoint GET /order, [details here](apidocs/order/README.md#get-orders)

## [2018-11-14]
### Changed
- product `regionalLimitations` field now stores a *name of region* instead of url to icon
- fields such as `originalName`, `description`, `coverImage`, `screenshots`, `videos`, `developers`, `publishers` and `releaseDate` have become optional fields and may not be accessible for all products
- product `sortBy` field has been limited to `kingiunId`, `name`, `qty` and `price` values
- product `sortType` filed has been limited to `asc` and `desc`
  
### Added
- product `regionId` filed which stores id of *region name*, [details here](apidocs/products/README.md#regions)
- `originalName` field which stores base name of product
- `isPreorder` field
- `status` filed which indicates if offer is active and ready to buy at Kinguin platform. The valid product should have `active` status. *IMPORTANT: Products only with that status can be ordered at Kinguin platform*
- `type` field which stores the type of product. For now there is only one `serial` available value. *IMPORTANT: Only `serial` products will be exposed by Product Api*
- `systemRequirements` field which stores list of hardware requirements for the product
- `tags` field which stores list of product's tags, [details here](apidocs/products/README.md#tags)
- added `isPreorder` parameter to query filters (acceptable values are `yes` and `no`)
- added `activePreorder` parameter to query filters (acceptable value is `yes`). It checks only the date of preorder activity, so if you want get only active preorders just use both parameters `isPreorder=yes` and `activePreorder=yes`
- added `regionId` parameter to query filters
- added `tags` parameter to query filters. It should be comma separated list of tags
- added `updatedSince` and `updatedTo` parameters to query filters. Both should be a valid UTC date. It allows to filter products by last update date

## [2018-11-13]
### Changed
- improved [errors and messages](apidocs/ErrorsCodes.md)

### Added
- `kinguinId` in order/dispatch/keys endpoint
