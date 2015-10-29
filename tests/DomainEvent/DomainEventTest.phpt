<?php

namespace Test;

use Tester;
use Tester\Assert;
use Esports\DomainEvents;

require __DIR__ . '/../bootstrap.php';

class DomainEventTest extends Tester\TestCase {

	function setUp() {
	}

	function testRaiseEvents() {
		$domainObject = new DomainObject;
		$domainObject->setName("Any name");
		$events = $domainObject->popEvents();

		Assert::same(2, count($events));
		Assert::true($events[0] instanceof DomainCreateEvent);
		Assert::true($events[1] instanceof DomainUpdateEvent);
		Assert::same("DomainObject was created!", $events[0]->getMessage());
		Assert::same("DomainObject was renamed to Any name!", $events[1]->getMessage());
	}

}

class DomainObject implements DomainEvents\DomainEventing {

	use DomainEvents\EventProvider;

	public function __construct() {
		$this->raise(new DomainCreateEvent("DomainObject was created!"));
	}

	public function setName($name) {
		$this->raise(new DomainUpdateEvent("DomainObject was renamed to $name!"));
	}

}

class DomainCreateEvent extends \Doctrine\Common\EventArgs {

	/** @var string */
	private $message;

	function __construct($message) {
		$this->message = $message;
	}

	function getMessage() {
		return $this->message;
	}

}

class DomainUpdateEvent extends \Doctrine\Common\EventArgs {

	/** @var string */
	private $message;

	function __construct($message) {
		$this->message = $message;
	}

	function getMessage() {
		return $this->message;
	}

}

$test = new DomainEventTest();
$test->run();
