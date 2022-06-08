# API BileMo

**Version de l'API :** `1.0-20220607`

En cas de doute vis à vis des termes, référez vous au [glossaire](glossary.md).

---

## Produits
### Consulter la liste des produits BileMo
#### Route
```
/api/products
```

#### Méthode
```
- GET
```

#### Réponse

**HTTP OK (200)** : La requête s'est déroulée correctement.

```json
[
    {
        "id": number,
        "brand": "string",
        "operatingSystem": "string",
        "cpu": "string",
        "storage": "string",
        "screenSize": "string",
        "screenType": "string",
        "year": "string",
        "price": float
    },
    {
        "id": number,
        "brand": "string",
        "operatingSystem": "string",
        "cpu": "string",
        "storage": "string",
        "screenSize": "string",
        "screenType": "string",
        "year": "string",
        "price": float
    },
    // ...
]
```

#### Erreurs possibles
**HTTP BAD REQUEST (400)**: Quelque chose dans votre requête ne fonctionne pas. Vérifier le lien ou toute faute de frappe éventuelle.


---

### Consulter le détail d'un produit BileMo
#### Route
```
/api/products/{id}
```

#### Méthode
```
- GET
```

#### Réponse

**HTTP OK (200)** : La requête s'est déroulée correctement.

```json
{
    "id": number,
    "brand": "string",
    "operatingSystem": "string",
    "cpu": "string",
    "storage": "string",
    "screenSize": "string",
    "screenType": "string",
    "year": "string",
    "price": float
}
```

#### Erreurs possibles
**HTTP BAD REQUEST (400)** : Quelque chose dans votre requête ne fonctionne pas. Vérifier le lien ou toute faute de frappe éventuelle.

**HTTP UNAUTHORIZED (401)** : Vous ne disposez pas d'accès à l'API. Vérifiez si vous êtes connecté•e avant de réessayer votre requête.

**HTTP FORBIDDEN (403)** : Vous n'avez pas l'autorisation de procéder à cette requête. Vous n'en disposez pas les droits.

**HTTP NOT FOUND (404)** : Le produit spécifié dans l'IRI n'est pas correct. Peut-être avez-vous fait une erreur ou qu'il a été supprimé.

---

## Clients
### Afficher tous les clients liés à un partenaire sur le site web

Cette requête affiche tous les clients d'un partenaire. Ce chemin peut être vu uniquement par partenaires qui veulent voir leur clientèle. Cela peut ainsi servir à obtenir les fiches de ses clients.

#### Route
```
/api/partners/{partnerId}/customers
```

#### Méthode
```
- GET
```

#### Réponse

**HTTP OK (200)** : La requête s'est déroulée correctement.

```json
{
    "id": number,
    "name": "string",
    "email": "string",
    "postalAddress": "string",
    "phoneNumber": "string",
    "vatNumber": "string",
    "siret": "string",
    "customers": [
        {
            "id": number,
            "name": "string",
            "email": "string",
            "postalAddress": "string",
            "phoneNumber": "string"
        },
        {
            "id": number,
            "name": "string",
            "email": "string",
            "postalAddress": "string",
            "phoneNumber": "string"
        },
        {
            "id": number,
            "name": "string",
            "email": "string",
            "postalAddress": "string",
            "phoneNumber": "string"
        },
        // ... pour autant de clients présents dans la base de données
    ]
}
```

#### Erreurs possibles
**HTTP BAD REQUEST (400)** : Quelque chose dans votre requête ne fonctionne pas. Vérifier le lien ou toute faute de frappe éventuelle.

**HTTP UNAUTHORIZED (401)** : Vous ne disposez pas d'accès à l'API. Vérifiez si vous êtes connecté•e avant de réessayer votre requête.

**HTTP FORBIDDEN (403)** : Vous n'avez pas l'autorisation de procéder à cette requête. Vous n'en disposez pas les droits.

**HTTP NOT FOUND (404)** : Le produit spécifié dans l'IRI n'est pas correct. Peut-être avez-vous fait une erreur ou qu'il a été supprimé.


---

### Afficher un client lié à un partenaire

Lorsque vous faites une requête pour voir le détail d'un client, vous allez aussi obtenir le partenaire auquel il est lié.

#### Route
```
/api/{partnerId}/customers/{customerId}
```

#### Méthode
```
- GET
```

#### Réponse

**HTTP OK (200)** : La requête s'est déroulée correctement.

```json
{
    "id": number,
    "name": "string",
    "email": "string",
    "postalAddress": "string",
    "phoneNumber": "string",
    "reseller": {
        "email": "string",
        "postalAddress": "string",
        "phoneNumber": "string",
        "vatNumber": "string",
        "siret": "string"
    }
}
```

#### Erreurs possibles
**HTTP BAD REQUEST (400)** : Quelque chose dans votre requête ne fonctionne pas. Vérifier le lien ou toute faute de frappe éventuelle.

**HTTP UNAUTHORIZED (401)** : Vous ne disposez pas d'accès à l'API. Vérifiez si vous êtes connecté•e avant de réessayer votre requête.

**HTTP FORBIDDEN (403)** : Vous n'avez pas l'autorisation de procéder à cette requête. Vous n'en disposez pas les droits.

**HTTP NOT FOUND (404)** : Le produit spécifié dans l'IRI n'est pas correct. Peut-être avez-vous fait une erreur ou qu'il a été supprimé.


---


### Ajouter un nouveau client
#### Route
```
/api/customers/new
```

#### Méthode
```
- POST
```

#### Réponse

**HTTP RESOURCE CREATED (201)** : La création de l'object s'est déroulée correctement.

```json
{
    "id": number,
    "name": "string",
    "email": "string",
    "password": "string",
    "postalAddress": "string",
    "phoneNumber": "string",
    "reseller": number
},
```

#### Erreurs possibles
**HTTP BAD REQUEST (400)** : Quelque chose dans votre requête ne fonctionne pas. Vérifier le lien ou toute faute de frappe éventuelle.

**HTTP UNAUTHORIZED (401)** : Vous ne disposez pas d'accès à l'API. Vérifiez si vous êtes connecté•e avant de réessayer votre requête.

**HTTP FORBIDDEN (403)** : Vous n'avez pas l'autorisation de procéder à cette requête. Vous n'en disposez pas les droits.


---

### Supprimer un client
#### Route
```
/api/partners/{partnerId}/customers/{customerId}/delete
```

#### Méthode
```
- DELETE
```

#### Réponse
**HTTP NO CONTENT (204)** : La suppression s'est déroulée correctement

#### Erreurs possibles
**HTTP BAD REQUEST (400)** : Quelque chose dans votre requête ne fonctionne pas. Vérifier le lien ou toute faute de frappe éventuelle.

**HTTP UNAUTHORIZED (401)** : Vous ne disposez pas d'accès à l'API. Vérifiez si vous êtes connecté•e avant de réessayer votre requête.

**HTTP FORBIDDEN (403)** : Vous n'avez pas l'autorisation de procéder à cette requête. Vous n'en disposez pas les droits.

**HTTP NOT FOUND (404)** : Le produit spécifié dans l'IRI n'est pas correct. Peut-être avez-vous fait une erreur ou qu'il a déjà été supprimé.

