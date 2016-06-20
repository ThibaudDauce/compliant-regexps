# Compliant Regexps

The main goal of this library is to provide an easy way to correct user input based on regular expressions.

## Installation

```
composer require thibaud-dauce/compliant-regexps
```

## Usage

The `tests` folder provides good usage examples.

### Basic usage

```php
<?php

$conciliator = new WhiteSpace;
$possibilities = $conciliator->conciliate('/^Flat J114$/', 'Flat J 114');

// $possibilities = ['FlatJ 114', 'Flat J114']
```

```php
<?php

$conciliator = new StartWith;
$possibilities = $conciliator->conciliate('/^Flat J114$/', 'J114');

// $possibilities = ['Flat J114']
```

### Only valid results

```php
<?php

$conciliator = new ValidOnly(new WhiteSpace);
$possibilities = $conciliator->conciliate('/^Flat J114$/', 'Flat J 114');

// $possibilities = ['Flat J114']
```

### Multiple conciliators

```php
<?php

$conciliator = new Aggregator([new StartWith, new WhiteSpace]);
$possibilities = $conciliator->conciliate('/^Flat J114$/', 'J 114');

// $possibilities = ['J 114', 'Flat J 114', 'J114', 'FlatJ 114', 'Flat J114']
```

Or with only valid results:

```php
<?php

$conciliator = new ValidOnly(new Aggregator([new StartWith, new WhiteSpace]));
$possibilities = $conciliator->conciliate('/^Flat J114$/', 'J 114');

// $possibilities = ['Flat J114']
```


