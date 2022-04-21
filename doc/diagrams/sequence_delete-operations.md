```mermaid
    sequenceDiagram
    participant U as <<Actor>><br/>User
    participant S as <<Interface>><br/>Symfony
    participant D as <<Interface>><br/>Database / Doctrine

    note left of U: DELETE OPERATION<br/>Deletes selected resource
    U ->> S: Request resource to delete in client in JSON format
    activate U
    activate S
    note right of U: Can be new Partner, Customer, or Product
    alt User has API key
        S -->> S: Security checks role
        alt Request is correct
            S ->> D: Select resource by id
            activate D
            S ->> D: Delete resource
            D -->> S: Display feedback
            deactivate D
            S -->> U: Display Response
            note right of S: Response 200 - OK
        else User makes request out of their roles
            S -->> U: Permission denied
            note right of S: Response 403 - Forbidden
            note right of S: Security bundle
        else User makes uncaught bad request
            S -->> U: Uncaught exception
            note right of S: Response 500 - Server Error
        end
    else User does not have API key
        S -->> U: API Key is missing
        note right of S: Response 401 - Unauthorized
        note right of S: JWT and security
        deactivate S
    end
    deactivate U
```