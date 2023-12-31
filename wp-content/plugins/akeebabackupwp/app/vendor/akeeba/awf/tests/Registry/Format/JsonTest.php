<?php
/**
 * @package   awf
 * @copyright Copyright (c)2014-2022 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license   GNU GPL version 3 or later
 */

namespace Awf\Tests\Registry\Format;

use Awf\Registry\AbstractRegistryFormat;

/**
 * @coversDefaultClass Awf\Registry\Format\Json
 *
 * @package Awf\Tests\Registry\Format
 */
class JsonTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * Test the Json::objectToString method.
	 *
	 * @return  void
	 *
	 * @since   1.0
	 */
	public function testObjectToString()
	{
		$class = AbstractRegistryFormat::getInstance('JSON');
		$options = null;
		$object = new \stdClass;
		$object->foo = 'bar';
		$object->quoted = '"stringwithquotes"';
		$object->booleantrue = true;
		$object->booleanfalse = false;
		$object->numericint = 42;
		$object->numericfloat = 3.1415;

		// The PHP registry format does not support nested objects
		$object->section = new \stdClass;
		$object->section->key = 'value';
		$object->array = array('nestedarray' => array('test1' => 'value1'));

		$string = '{"foo":"bar","quoted":"\"stringwithquotes\"",' .
			'"booleantrue":true,"booleanfalse":false,' .
			'"numericint":42,"numericfloat":3.1415,' .
			'"section":{"key":"value"},' .
			'"array":{"nestedarray":{"test1":"value1"}}' .
			'}';

		// Test basic object to string.
		$this->assertThat(
			$class->objectToString($object, $options),
			$this->equalTo($string)
		);
	}

	/**
	 * Test the Json::stringToObject method.
	 *
	 * @return  void
	 *
	 * @since   1.0
	 */
	public function testStringToObject()
	{
		$class = AbstractRegistryFormat::getInstance('JSON');

		$string1 = '{"title":"Foobar","author":"Me","params":{"show_title":1,"show_abstract":0,"show_author":1,"categories":[1,2]}}';
		$string2 = "[section]\nfoo=bar";

		$object1 = new \stdClass;
		$object1->title = 'Foobar';
		$object1->author = 'Me';
		$object1->params = new \stdClass;
		$object1->params->show_title = 1;
		$object1->params->show_abstract = 0;
		$object1->params->show_author = 1;
		$object1->params->categories = array(1, 2);

		$object2 = new \stdClass;
		$object2->section = new \stdClass;
		$object2->section->foo = 'bar';

		$object3 = new \stdClass;
		$object3->foo = 'bar';

		// Test basic JSON string to object.
		$object = $class->stringToObject($string1, array('processSections' => false));
		$this->assertThat(
			$object,
			$this->equalTo($object1),
			'Line:' . __LINE__ . ' The complex JSON string should convert into the appropriate object.'
		);

		// Test INI format string without sections.
		$object = $class->stringToObject($string2, array('processSections' => false));
		$this->assertThat(
			$object,
			$this->equalTo($object3),
			'Line:' . __LINE__ . ' The INI string should convert into an object without sections.'
		);

		// Test INI format string with sections.
		$object = $class->stringToObject($string2, array('processSections' => true));
		$this->assertThat(
			$object,
			$this->equalTo($object2),
			'Line:' . __LINE__ . ' The INI string should covert into an object with sections.'
		);

		/**
		 * Test for bad input
		 * Everything that is not starting with { is handled by
		 * Format\Ini, which we test seperately
		 */
		$this->assertThat(
			$class->stringToObject('{key:\'value\''),
			$this->equalTo(false)
		);
	}
}
