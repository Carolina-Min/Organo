<?php
/**
 * @package   awf
 * @copyright Copyright (c)2014-2022 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license   GNU GPL version 3 or later
 */

namespace Awf\Tests\Utils;

use Awf\Utils\Collection;

class CollectionTest extends \PHPUnit_Framework_TestCase
{
	public function testFirstReturnsFirstItemInCollection()
	{
		$c = new Collection(array('foo', 'bar'));
		$this->assertEquals('foo', $c->first());
	}


	public function testLastReturnsLastItemInCollection()
	{
		$c = new Collection(array('foo', 'bar'));

		$this->assertEquals('bar', $c->last());
	}


	public function testPopReturnsAndRemovesLastItemInCollection()
	{
		$c = new Collection(array('foo', 'bar'));

		$this->assertEquals('bar', $c->pop());
		$this->assertEquals('foo', $c->first());
	}


	public function testShiftReturnsAndRemovesFirstItemInCollection()
	{
		$c = new Collection(array('foo', 'bar'));

		$this->assertEquals('foo', $c->shift());
		$this->assertEquals('bar', $c->first());
	}


	public function testEmptyCollectionIsEmpty()
	{
		$c = new Collection();

		$this->assertTrue($c->isEmpty());
	}


	public function testToArrayCallsToArrayOnEachItemInCollection()
	{
		$item1 = $this->getMock('Awf\\Registry\\Registry', array('toArray'));
		$item1
			->expects($this->once())
			->method('toArray')
			->will($this->returnValue('foo.array'));

		$item2 = $this->getMock('Awf\\Registry\\Registry', array('toArray'));
		$item2
			->expects($this->once())
			->method('toArray')
			->will($this->returnValue('bar.array'));

		$c = new Collection(array($item1, $item2));
		$results = $c->toArray();

		$this->assertEquals(array('foo.array', 'bar.array'), $results);
	}


	public function testToJsonEncodesTheToArrayResult()
	{
		$c = $this->getMock('Awf\Utils\Collection', array('toArray'));
		$c->expects($this->once())->method('toArray')->will($this->returnValue('foo'));
		$results = $c->toJson();

		$this->assertEquals(json_encode('foo'), $results);
	}


	public function testCastingToStringJsonEncodesTheToArrayResult()
	{
		$c = $this->getMock('Awf\Utils\Collection', array('toArray'));
		$c->expects($this->once())->method('toArray')->will($this->returnValue('foo'));

		$this->assertEquals(json_encode('foo'), (string) $c);
	}


	public function testOffsetAccess()
	{
		$c = new Collection(array('name' => 'foo'));
		$this->assertEquals('foo', $c['name']);
		$c['name'] = 'bar';
		$this->assertEquals('bar', $c['name']);
		$this->assertTrue(isset($c['name']));
		unset($c['name']);
		$this->assertFalse(isset($c['name']));
		$c[] = 'baz';
		$this->assertEquals('baz', $c[0]);
	}


	public function testCountable()
	{
		$c = new Collection(array('foo', 'bar'));
		$this->assertEquals(2, count($c));
	}


	public function testIterable()
	{
		$c = new Collection(array('foo'));
		$this->assertInstanceOf('ArrayIterator', $c->getIterator());
		$this->assertEquals(array('foo'), $c->getIterator()->getArrayCopy());
	}


	public function testCachingIterator()
	{
		$c = new Collection(array('foo'));
		$this->assertInstanceOf('CachingIterator', $c->getCachingIterator());
	}


	public function testFilter()
	{
		$c = new Collection(array(array('id' => 1, 'name' => 'Hello'), array('id' => 2, 'name' => 'World')));
		$this->assertEquals(array(1 => array('id' => 2, 'name' => 'World')), $c->filter(function($item)
		{
			return $item['id'] == 2;
		})->all());
	}


	public function testValues()
	{
		$c = new Collection(array(array('id' => 1, 'name' => 'Hello'), array('id' => 2, 'name' => 'World')));
		$this->assertEquals(array(array('id' => 2, 'name' => 'World')), $c->filter(function($item)
		{
			return $item['id'] == 2;
		})->values()->all());
	}


	public function testFlatten()
	{
		$c = new Collection(array(array('#foo', '#bar'), array('#baz')));
		$this->assertEquals(array('#foo', '#bar', '#baz'), $c->flatten()->all());
	}


	public function testMergeArray()
	{
		$c = new Collection(array('name' => 'Hello'));
		$this->assertEquals(array('name' => 'Hello', 'id' => 1), $c->merge(array('id' => 1))->all());
	}


	public function testMergeCollection()
	{
		$c = new Collection(array('name' => 'Hello'));
		$this->assertEquals(array('name' => 'World', 'id' => 1), $c->merge(new Collection(array('name' => 'World', 'id' => 1)))->all());
	}


	public function testDiffCollection()
	{
		$c = new Collection(array('id' => 1, 'first_word' => 'Hello'));
		$this->assertEquals(array('id' => 1), $c->diff(new Collection(array('first_word' => 'Hello', 'last_word' => 'World')))->all());
	}


	public function testIntersectCollection()
	{
		$c = new Collection(array('id' => 1, 'first_word' => 'Hello'));
		$this->assertEquals(array('first_word' => 'Hello'), $c->intersect(new Collection(array('first_world' => 'Hello', 'last_word' => 'World')))->all());
	}


	public function testUnique()
	{
		$c = new Collection(array('Hello', 'World', 'World'));
		$this->assertEquals(array('Hello', 'World'), $c->unique()->all());
	}


	public function testCollapse()
	{
		$data = new Collection(array(array($object1 = new \StdClass), array($object2 = new \StdClass)));
		$this->assertEquals(array($object1, $object2), $data->collapse()->all());
	}


	public function testSort()
	{
		$data = new Collection(array(5, 3, 1, 2, 4));
		$data->sort(function($a, $b)
		{
			if ($a === $b)
			{
				return 0;
			}
			return ($a < $b) ? -1 : 1;
		});

		$this->assertEquals(range(1, 5), array_values($data->all()));
	}


	public function testSortBy()
	{
		$data = new Collection(array('foo', 'bar'));
		$data = $data->sortBy(function($x) { return $x; });

		$this->assertEquals(array('bar', 'foo'), array_values($data->all()));

		$data = new Collection(array('bar', 'foo'));
		$data->sortByDesc(function($x) { return $x; });

		$this->assertEquals(array('foo', 'bar'), array_values($data->all()));
	}


	public function testSortByString()
	{
		$data = new Collection(array(array('name' => 'foo'), array('name' => 'bar')));
		$data = $data->sortBy('name');

		$this->assertEquals(array(array('name' => 'bar'), array('name' => 'foo')), array_values($data->all()));
	}


	public function testReverse()
	{
		$data = new Collection(array('foo', 'bar'));
		$reversed = $data->reverse();

		$this->assertEquals(array('bar', 'foo'), array_values($reversed->all()));
	}

	public function testListsWithArrayAndObjectValues()
	{
		$data = new Collection(array((object) array('name' => 'kot', 'email' => 'foo'), array('name' => 'lol', 'email' => 'bar')));
		$this->assertEquals(array('kot' => 'foo', 'lol' => 'bar'), $data->lists('email', 'name'));
		$this->assertEquals(array('foo', 'bar'), $data->lists('email'));
	}


	public function testImplode()
	{
		$data = new Collection(array(array('name' => 'kot', 'email' => 'foo'), array('name' => 'lol', 'email' => 'bar')));
		$this->assertEquals('foobar', $data->implode('email'));
		$this->assertEquals('foo,bar', $data->implode('email', ','));
	}


	public function testTake()
	{
		$data = new Collection(array('foo', 'bar', 'baz'));
		$data = $data->take(2);
		$this->assertEquals(array('foo', 'bar'), $data->all());
	}


	public function testRandom()
	{
		$data = new Collection(array(1, 2, 3, 4, 5, 6));
		$random = $data->random();
		$this->assertInternalType('integer', $random);
		$this->assertContains($random, $data->all());
		$random = $data->random(3);
		$this->assertCount(3, $random);
	}


	public function testTakeLast()
	{
		$data = new Collection(array('foo', 'bar', 'baz'));
		$data = $data->take(-2);
		$this->assertEquals(array('bar', 'baz'), $data->all());
	}


	public function testTakeAll()
	{
		$data = new Collection(array('foo', 'bar', 'baz'));
		$data = $data->take();
		$this->assertEquals(array('foo', 'bar', 'baz'), $data->all());
	}


	public function testMakeMethod()
	{
		$collection = Collection::make('foo');
		$this->assertEquals(array('foo'), $collection->all());
	}


	public function testSplice()
	{
		$data = new Collection(array('foo', 'baz'));
		$data->splice(1, 0, 'bar');
		$this->assertEquals(array('foo', 'bar', 'baz'), $data->all());

		$data = new Collection(array('foo', 'baz'));
		$data->splice(1, 1);
		$this->assertEquals(array('foo'), $data->all());

		$data = new Collection(array('foo', 'baz'));
		$cut = $data->splice(1, 1, 'bar');
		$this->assertEquals(array('foo', 'bar'), $data->all());
		$this->assertEquals(array('baz'), $cut->all());
	}


	public function testGetListValueWithAccessors()
	{
		$model    = new TestAccessorAwfTestStub(array('some' => 'foo'));
		$modelTwo = new TestAccessorAwfTestStub(array('some' => 'bar'));
		$data     = new Collection(array($model, $modelTwo));

		$this->assertEquals(array('foo', 'bar'), $data->lists('some'));
	}


	public function testTransform()
	{
		$data = new Collection(array('foo', 'bar', 'baz'));
		$data->transform(function($item) { return strrev($item); });
		$this->assertEquals(array('oof', 'rab', 'zab'), array_values($data->all()));
	}


	public function testFirstWithCallback()
	{
		$data = new Collection(array('foo', 'bar', 'baz'));
		$result = $data->first(function($key, $value) { return $value === 'bar'; });
		$this->assertEquals('bar', $result);
	}


	public function testFirstWithCallbackAndDefault()
	{
		$data = new Collection(array('foo', 'bar'));
		$result = $data->first(function($key, $value) { return $value === 'baz'; }, 'default');
		$this->assertEquals('default', $result);
	}


	public function testGroupByAttribute()
	{
		$data = new Collection(array(array('rating' => 1, 'name' => '1'), array('rating' => 1, 'name' => '2'), array('rating' => 2, 'name' => '3')));
		$result = $data->groupBy('rating');
		$this->assertEquals(array(1 => array(array('rating' => 1, 'name' => '1'), array('rating' => 1, 'name' => '2')), 2 => array(array('rating' => 2, 'name' => '3'))), $result->toArray());
	}


	public function testGettingSumFromCollection()
	{
		$c = new Collection(array((object) array('foo' => 50), (object) array('foo' => 50)));
		$this->assertEquals(100, $c->sum('foo'));

		$c = new Collection(array((object) array('foo' => 50), (object) array('foo' => 50)));
		$this->assertEquals(100, $c->sum(function($i) { return $i->foo; }));
	}


	public function testGettingSumFromEmptyCollection()
	{
		$c = new Collection();
		$this->assertEquals(0, $c->sum('foo'));
	}
}

class TestAccessorAwfTestStub
{
	protected $attributes = array();

	public function __construct($attributes)
	{
		$this->attributes = $attributes;
	}


	public function __get($attribute)
	{
		$accessor = 'get' .lcfirst($attribute). 'Attribute';
		if (method_exists($this, $accessor)) {
			return $this->$accessor();
		}

		return $this->$attribute;
	}


	public function getSomeAttribute()
	{
		return $this->attributes['some'];
	}
}
