# Game of Tests

[![Packagist](https://img.shields.io/packagist/v/swisnl/game-of-tests.svg?maxAge=2592000)](https://packagist.org/packages/swisnl/game-of-tests) [![Build Status](https://travis-ci.org/swisnl/game-of-tests.svg?branch=master)](https://travis-ci.org/swisnl/game-of-tests) 

This package serves as a way to search through git repositories and find PHP tests. I was inspired by the the [Spotify testing game](https://github.com/spotify/testing-game) I ran in to.

The reason i wanted to my own implementatino for PHP was to help gamify testing in the company and encourage testing in general in the teams.

## How to use

### Remote

You can inspect a remote repository as follows. This will create a local repository in the path specifiek in ``\Swis\GoT\Settings`` and use that to find the tests and test owners.

```php
$inspector = new \Swis\GoT\Inspector();
$repository = $inspector->getRepositoryByUrl('git@github.com:swisnl/game-of-tests.git');
$results = $inspector->inspect($repository);
```

### Local

If you have a local repository, you can also use that directly, for example if you have a set of base repositories as backups, that it fine.

```php
$inspector = new \Swis\GoT\Inspector();
$repository = $inspector->getRepositoryByPath('/path/to/repos');
$results = $inspector->inspect($repository);
```

### Settings

You can use the ``\Swis\GoT\Settings`` class to set some settings for the package. It lists the available parsers, some paths that are skipped by default and the path where the remote repositories are stored localy.
  
## Parsers
  
There are currently 3 parsers defined. PhpUnit, Codeception and Behat. A parser is a small class that defines how to find files that are tests, and how to count tests for that type.

A parser return an array with ``\Swis\GoT\Result`` objects that contain the information on the test.

## Example command

The repository includes a small example command for Laravel, should you want to want to use it there.

Want an implementation as a Laravel service provider? Check out [swisnl/game-of-tests-laravel](https://github.com/swisnl/game-of-tests-laravel).
