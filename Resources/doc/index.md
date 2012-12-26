OrkestraTransactorBundle
========================

Provides integration between Symfony 2 applications and the Orkestra Transactor
payment processing library.


## Installation

Install via composer


## Configuration

### Encryption

To enable encryption of the account number field on all account entities,
set `enable_encryption` to true in config.yml.

``` yaml
# app/config/config.yml

orkestra_transactor:
  enable_encryption: true
```

Encryption is handled transparently using the `encrypted_string` column type
provided by orkestra-common.


