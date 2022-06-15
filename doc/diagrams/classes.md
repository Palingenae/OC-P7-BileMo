```mermaid
    classDiagram
        Customer "0..n" --* "0..n" Product: Orders
        Partner "0..n" --* "1..n" Product: Resells
        Partner "1..n" --* "0..n" Customer: Sells to
        %% Those who will order the products %%
        class Customer {
            - string $name
            - string $email
            - string $password
            - string $postalAddress
            - string $phoneNumber
            - Collection<Product> $orders
        }
        %% As in BileMo's Commercial Partner %%
        class Partner {
            - string $name
            - string $email
            - string $password
            - string $postalAddress
            - string $phoneNumber
            - string $vatNumber
            - string $siret
            - string $token?
        }
        %% Asserting that they will only make a phone catalog %%
        class Product {
            - string $modelName
            - string $brand
            - string $operatingSystem
            - string $cpu
            - string $storage
            - string $screenSize
            - string $screenType
            - string $year
            - float $price
        }
```
