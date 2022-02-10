# data-object
A wrapper class that supports all types of getX, setX, and unsX methods. Inspired by [Magento's DataObect](https://www.codilar.com/data-objects-magento-2)

## Installation

    composer require jayankaghosh/dataobject

## Usage

    <?php

    require_once __DIR__ . '/vendor/autoload.php';


    // Basic
    $dataObject = new \DataObject\DataObject(); // Create an object of DataObject
    $dataObject->setMessage('Hello PHP'); // Even though method setMessage is not defined anywhere
    echo $dataObject->getMessage(); // We still get the output as "Hello PHP"


    // Default Values
    $dataObject = new \DataObject\DataObject(['nuclear_code' => 12345]); // Create an object of DataObject. Notice we passed an array into the constructor
    $dataObject->setMessage('Hello PHP'); // Even though method setMessage is not defined anywhere
    echo $dataObject->getMessage(); // We still get the output as "Hello PHP"
    echo $dataObject->getNuclearCode(); // And calling this method gives us the output as "12345" because of the default values passed in the constructor

    // getData and setData
    $dataObject = new \DataObject\DataObject();
    $dataObject->setData('name', 'bond...james bond'); // This will save the value with the key 'name'
    echo $dataObject->getData('name'); // Which we can later retrieve like this
    echo $dataObject->getName(); // or this
