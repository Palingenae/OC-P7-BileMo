```mermaid
    erDiagram
        CUSTOMER }o--o{ PRODUCT: Orders
        PARTNER }o--o{ PRODUCT: Resells
        PARTNER ||--|{ CUSTOMER: Sells

        %% Those who will order the products %%
        CUSTOMER {
            VARCHAR name
            VARCHAR email
            VARCHAR password
            VARCHAR postalAddress
            VARCHAR phoneNumber
        }
        %% As in BileMo's Commercial Partner %%
        PARTNER {
            VARCHAR name
            VARCHAR email
            VARCHAR password
            VARCHAR postalAddress
            VARCHAR phoneNumber
            VARCHAR vatNumber
            VARCHAR siret
            VARCHAR token
        }
        %% Asserting that they will only make a phone catalog %%
        PRODUCT {
            VARCHAR modelName
            VARCHAR brand
            VARCHAR operatingSystem
            VARCHAR cpu
            VARCHAR storage
            VARCHAR screenSize
            VARCHAR screenType
            VARCHAR year
            INT price
        }
```
