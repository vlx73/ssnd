# PostgreSQL 
## Vytvoríme tabuľku "User"

```sql
CREATE TABLE public."User"
(
    id         uuid              NOT NULL,
    first_name character varying,
    last_name  character varying,
    email      character varying NOT NULL,
    password   character varying NOT NULL,
    CONSTRAINT user_email_unique UNIQUE NULLS NOT DISTINCT (email)
);
```
- `id` je unikátny identifikátor používateľa používame formát `uuid`
- `first_name` je meno používateľa
- `last_name` je priezvisko používateľa
- `email` je email používateľa. Musí byť unikátny, lebo ho budeme používať zároveň ako login, rovnako musí byť povinný
- `password` je heslo používateľa. Musí byť povinné

