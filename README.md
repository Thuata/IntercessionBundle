# Intercession Bundle

[![Build Status](https://travis-ci.org/Thuata/IntercessionBundle.svg?branch=v1.0)](https://travis-ci.org/Thuata/IntercessionBundle)

## Intercession principle

Intercession is the ability of a program to modify its own execution state. That mean intercession allows to generate and execute some code in live during the program execution.

The Intercession bundle is meant to generate class definitions and eventualy write it in a file. You are then free to include / require the file lively to have the new generated class available. The bundle provides also tools to add phpdoc.

## Warning

Take in consideration that code generation, if not safely used can be very dangerous and harmfull for your applications. You should only use intercession with code you understand. Using intercession with unsafe code or code from uncertain source (like from a form request) should be done in specific environments (ie. containers or virtual systems ).

Being aware of that intercession can be a very powerfull tool.

## Installation

### Step 1: Download the Bundle

In your composer.json file add the following lines :

```json
{
    "require": {
      // ...
        "thuata/intercessionbundle": "^1",
      // ...
    }
}

```

or directly with composer on command line :

```bash
composer require thuata/intercessionbundle
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

### Step 2: Enable the Bundle

Then, enable the bundle by adding it to the list of registered bundles
in the `app/AppKernel.php` file of your project:

```php
<?php
// app/AppKernel.php

// ...
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...

            new Thuata\IntercessionBundle\ThuataIntercessionBundle,
        );

        // ...
    }

    // ...
}
```

## Usage

The intercession bundle provides some classes to prepare the Class, Methods and Properties definitions and a service to generate definition and / or write it in a file.

Here is a simple example that defines a class in a namspace. The class extends another one, implements some interfaces and uses some traits. It as a description and an author (for phpdoc)

```php

        $class = new IntercessionClass(); // instanciates the intercession class

        $class->setName('Foo'); // sets the class name ...
        $class->setNamespace('Bar/Baz'); // ... and the namespace
        $class->addAuthor('Anthony Maudry', 'anthony.maudry@thuata.com'); // the author (appears in phpdoc)
        $class->setDescription('The marvelous Foo class !'); // and a description (php doc too)
        $class->addInterface('\Bar\FooBarInterface'); // First interface to implement
        $class->addInterface('\Bar\BarFooInterface'); // and the second interface
        $class->addTrait('\Bar\FooBarTrait'); // one trait
        $class->addTrait('\Bar\BarFooTrait'); // another trait
        $class->setExtends('\Bar\AbstractFooBar'); // Foo class now extends another class
        
        /** @var GeneratorService $generator */
        $generator = $container->get('thuata_intercession.generator'); // get the generator from the conatainer
        // get the definition as string ...
        $definition = $generator->renderClass($class);
        // or write it directly in a file
        $fileName = '/some/path/to/a/file.php';
        $generator->createClassDefinitionFile($class, $fileName);
        
        // you can now include that file :
        include_once($fileName);
        // and instanciate your class :
        $foo = new \Bar\Baz\Foo();
```

A more complete document is coming.

## Next steps

This version is 1.0. It provides only definition generation.

next steps will provide :
- A full documentation
- Live edition of classes, even after instantiation
