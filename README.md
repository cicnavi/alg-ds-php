# alg-ds-php
Algorithms and Data Structures in PHP

## psysh
To use the available classes in psysh, do this:

```shell script
./vendor/bin/psysh
$fixedArray = new Cicnavi\Ds\Arrays\FixedArray(10);
```

## phpunit
To run all tests: 

```shell script
./vendor/bin/phpunit --testdox tests
```

To run specific test:
```shell script
./vendor/bin/phpunit --testdox tests/Ds/Arrays/FixedArrayTest.php
```