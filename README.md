
## Vending Machine System

PHP application for a vending machine system. This
system should support features like product management, inventory tracking, purchase
transactions, and user authentication.

## Run Locally

Clone the project

```bash
  git clone https://github.com/PhyoeZawAung/Vending_machine
```

```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
```

```bash
  ./vendor/bin/sail up
```
