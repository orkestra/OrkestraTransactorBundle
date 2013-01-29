OrkestraTransactorBundle
========================

[![Build Status](https://travis-ci.org/orkestra/OrkestraTransactorBundle.png?branch=master,develop)](https://travis-ci.org/orkestra/OrkestraTransactorBundle)

Integrates [orkestra-transactor](https://github.com/orkestra/orkestra-transactor) with Symfony 2.


## Installation

The easiest way to add OrkestraTransactorBundle to your project is using composer.

Add orkestra/transactor-bundle to your `composer.json` file:

``` json
{
    "require": {
        "orkestra/transactor-bundle": "dev-master"
    }
}
```

Then run `composer install` or `composer update`.



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


