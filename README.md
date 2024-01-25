## Installation


```sh
make init
make fixtures
```

### API:

Create Author 

```
curl --location 'http://127.0.0.1:8081/api/authors' \
--header 'Accept: application/json' \
--header 'Content-Type: application/json' \
--data '{
    "name": "andry",
    "surname": "test"
}'
```

List Authors

```
GET /api/authors?page=4 HTTP/1.1
Host: 127.0.0.1:8081
```

Create Book

```
curl --location 'http://127.0.0.1:8081/api/books' \
--header 'Accept: application/json' \
--form 'name="test12"' \
--form 'short_description="abba"' \
--form 'publish_date="1995-10-10"' \
--form 'image=@"/home/ruslan/Pictures/download.jpeg"' \
--form 'authors[]="2"'
```
Search Books

```
curl --location 'http://127.0.0.1:8081/api/books?page={page}&surname={search}' \
--header 'Accept: application/json'
```

Get Book

```
curl --location 'http://127.0.0.1:8081/api/books/{id}'
```

Edit Book

```
curl --location 'http://127.0.0.1:8081/api/books/{id}/edit' \
--header 'Content-Type: application/json' \
--header 'Accept: application/json' \
--form 'name="test123"' \
--form 'short_description="abba111"' \
--form 'publish_date="1995-10-10"' \
--form 'image=@"/home/ruslan/Pictures/avatar.jpeg"' \
--form 'authors[]="4"' \
--form 'authors[]="5"'
```