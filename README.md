# Buffertools

This library provides a `Buffer` and `Parser` class to make dealing with binary data in PHP easier.
`Templates` extend this by offering a read/write interface for larger serialized structures. 

This repository is the EthereumICO fork ([olegabr/buffertools-php](https://github.com/olegabr/buffertools-php))
of [Bit-Wasp/buffertools-php](https://github.com/Bit-Wasp/buffertools-php). It keeps the
`bitwasp/buffertools` package name and adds PHP 8.x fixes (empty buffers,
odd-length hex, explicit nullable types).

[![CI](https://github.com/olegabr/buffertools-php/actions/workflows/ci.yml/badge.svg)](https://github.com/olegabr/buffertools-php/actions/workflows/ci.yml)

## Requirements:

 * PHP 7.0+
 * Composer
 * ext-gmp

## Installation

 The fork is not published on Packagist, so projects point Composer at the repository:

```json
{
    "repositories": [
        { "type": "vcs", "url": "https://github.com/olegabr/buffertools-php" }
    ],
    "require": {
        "bitwasp/buffertools": "^0.5"
    }
}
```

  
## Examples 
 
 Buffer's are immutable classes to store binary data. 
 Buffer::hex can be used to initialize from hex
 Buffer::int can be used to initialize from a positive decimal integer (int|string)
   
 Buffer's main methods are:
  - getBinary()
  - getHex()
  - getInt()

 Parser will read Buffers. 
 Parser's main methods are: 
  - readBytes()
  - writeBytes()
  - readArray()
  - writeArray()
  
 In most cases, the interface offered by Parser should not be used directly. 
 Instead, Templates expose read/write access to larger serialized structures.
 
 - [Example 1: Using buffer to wrap binary data](./examples/usingBuffer.php) 
 - [Example 2: Using parser to extract binary data](./examples/usingParser.php) 
 - [Example 3: Using templates to read multiple elements from a parser](./examples/usingTemplates.php) 
 - [Example 4: Using templates to read/write structured messages](./examples/usingTemplates2.php) 
  
