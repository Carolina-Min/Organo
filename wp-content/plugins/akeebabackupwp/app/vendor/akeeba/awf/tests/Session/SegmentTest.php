<?php
/**
 * @package   awf
 * @copyright Copyright (c)2014-2022 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license   GNU GPL version 3 or later
 */

namespace Awf\Tests\Session;


use Awf\Session\CsrfTokenFactory;
use Awf\Session\Manager;
use Awf\Session\SegmentFactory;

class SegmentTest extends \PHPUnit_Framework_TestCase
{
	protected $session;

	protected $segment;

	protected $name = __CLASS__;

	protected function setUp()
	{
		$this->session = $this->newSession();
		$this->segment = $this->session->newSegment($this->name);
	}

	protected function newSession(array $cookies = array())
	{
		return new Manager(
			new SegmentFactory(),
			new CsrfTokenFactory(),
			$cookies
		);
	}

	protected function getValue($key = null)
	{
		if ($key) {
			return $_SESSION[$this->name][$key];
		} else {
			return $_SESSION[$this->name];
		}
	}

	protected function setValue($key, $val)
	{
		$_SESSION[$this->name][$key] = $val;
	}

	public function testGetName()
	{
		$this->assertSame($this->name, $this->segment->getName());
	}

	public function testMagicMethods()
	{
		@$this->session->destroy();
		@$this->session->start();

		// var not set
		$this->assertFalse(isset($this->segment->foo));

		// set the var and check isset
		$this->segment->foo = 'bar';
		$this->assertTrue(isset($this->segment->foo));

		// is the var value correct?
		$this->assertSame('bar', $this->segment->foo);

		// is the var value referenced in the data location?
		$this->assertSame('bar', $this->getValue('foo'));

		// unset and check
		unset($this->segment->foo);
		$this->assertFalse(isset($this->segment->foo));

		// set var from outside and check
		$this->setValue('foo', 'zim');
		$this->assertSame('zim', $this->segment->foo);
	}

	public function test__getNoSuchKey()
	{
		$this->assertNull($this->segment->foo);
	}

	public function testClear()
	{
		$this->segment->foo = 'bar';
		$this->segment->baz = 'dib';
		$this->assertSame('bar', $this->getValue('foo'));
		$this->assertSame('dib', $this->getValue('baz'));

		// now clear the data
		$this->segment->clear();
		$this->assertSame(array(), $this->getValue());
		$this->assertNull($this->segment->foo);
		$this->assertNull($this->segment->baz);
	}

	public function testFlash()
	{
		// no message yet
		$this->assertFalse($this->segment->hasFlash('message'));

		// add a message
		$this->segment->setFlash('message', 'doom');
		$this->assertTrue($this->segment->hasFlash('message'));

		// read the message
		$expect = 'doom';
		$actual = $this->segment->getFlash('message');
		$this->assertSame($expect, $actual);

		// read-once means the message should be gone now
		$this->assertFalse($this->segment->hasFlash('message'));
		$this->assertNull($this->segment->getFlash('message'));

		// add message then clear it
		$this->segment->setFlash('message', 'doom');
		$this->segment->clearFlash();
		$this->assertFalse($this->segment->hasFlash('message'));
		$this->assertNull($this->segment->getFlash('message'));
	}

	public function test__getDoesStartSession()
	{
		$this->session->destroy();
		$this->assertFalse($this->session->isStarted());
		$foo = $this->segment->foo;
		$this->assertNull($foo);
		$this->assertTrue($this->session->isStarted());
	}

	public function test__getReactivatesSession()
	{
		// fake a cookie
		$cookies = array(
			$this->session->getName() => 'fake-cookie-value',
		);
		$this->session = $this->newSession($cookies);

		// should be active now, even though not started
		$this->assertTrue($this->session->isAvailable());

		// reset the segment to use the new session manager
		$this->segment = $this->session->newSegment($this->name);

		// this should restart the session
		$foo = $this->segment->foo;
		$this->assertTrue($this->session->isStarted());
	}

	public function test__setStartsSessionAndCanReadAfter()
	{
		$this->session->destroy();

		// no session yet
		$this->assertFalse($this->session->isStarted());

		// set it
		$this->segment->foo = 'bar';

		// session should have started
		$this->assertTrue($this->session->isStarted());

		// get it from the session
		$foo = $this->segment->foo;
		$this->assertSame('bar', $foo);

		// make sure it's actually in $_SESSION
		$this->assertSame($foo, $_SESSION[$this->name]['foo']);
	}

	public function test__issetDoesStartSession()
	{
		$this->session->destroy();
		$this->assertFalse($this->session->isStarted());
		$this->assertFalse(isset($this->segment->foo));
		$this->assertTrue($this->session->isStarted());
	}

	public function test__unsetDoesStartSession()
	{
		$this->session->destroy();
		$this->assertFalse($this->session->isStarted());
		unset($this->segment->foo);
		$this->assertTrue($this->session->isStarted());
	}

	public function testClearDoesStartSession()
	{
		$this->session->destroy();
		$this->assertFalse($this->session->isStarted());
		$this->segment->clear();
		$this->assertTrue($this->session->isStarted());
	}

	public function testSetFlashStartsSessionAndCanReadAfter()
	{
		// no session yet
		$this->session->destroy();
		$this->assertFalse($this->session->isStarted());

		// set it
		$this->segment->setFlash('foo', 'bar');

		// session should have started
		$this->assertTrue($this->session->isStarted());

		// should see it in the segment
		$this->assertTrue($this->segment->hasFlash('foo'));

		// should see it in the session
		$this->assertSame('bar', $_SESSION[$this->name]['__flash']['foo']);

		// now read it
		$foo = $this->segment->getFlash('foo');
		$this->assertSame('bar', $foo);

		// should not be there any more
		$this->assertFalse($this->segment->hasFlash('foo'));
		$this->assertFalse(isset($_SESSION[$this->name]['__flash']['foo']));
	}

	public function testGetFlashDoesStartSession()
	{
		$this->session->destroy();
		$this->assertFalse($this->session->isStarted());
		$this->assertNull($this->segment->getFlash('foo'));
		$this->assertTrue($this->session->isStarted());
	}

	public function testHasFlashDoesStartSession()
	{
		$this->session->destroy();
		$this->assertFalse($this->session->isStarted());
		$this->assertFalse($this->segment->hasFlash('foo'));
		$this->assertTrue($this->session->isStarted());
	}

}
