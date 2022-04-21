```mermaid
    classDiagram
        Person <|-- Customer: Extends
        Person <|-- Partner: Extends
        Customer "0..n" --> "0..n" Product: Orders
        Partner "0..n" --> "1..n" Product: Resells
        Partner "1..n" --> "0..n" Customer: Sells to
        class Person {
            - string $name
            - string $email
            - string $password
            - string $postalAddress
            - string $phoneNumber
        }
        %% Those who will order the products %%
        class Customer {
            - Collection<Product> $orders
        }
        %% As in BileMo's Commercial Partner %%
        class Partner {
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
