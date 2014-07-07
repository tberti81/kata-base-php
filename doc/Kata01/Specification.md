# Kata 1 - Supermarket pricing

We have a web shopping cart, which can hold multiple individual items and we need to be able to do various tasks with these.

## Tasks

1. Add and remove products in the shopping cart
2. Get a listing of the products in the cart
3. Get the aggregated prices with the list
4. Get the total price for the cart
5. Pay x get y free discount
6. Discount by percentage

### Addition

* Items are grouped by type in the cart (if we put in 1 apple then another the list should state "apple x2" and not apple twice)
* All items have their own unit
* Listing should contain all available information:
    * Product name
    * Price
    * Currency
    * Unit
    * Amount

## Products

* **Apple**: 32 / kg
* **Light**: 15 / year
* **Starship**: 999.99 / piece
