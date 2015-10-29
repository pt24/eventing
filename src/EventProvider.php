<?php

namespace Esports\DomainEvents;

use Doctrine\Common\EventArgs;

/**
 * Trait zajistujici spravu eventu.
 * Implementuje DomainEventing::popEvents.
 */
trait EventProvider {

	/**
	 * @var EventArgs[]
	 */
	private $events = [];

	/**
	 * @return EventArgs[]
	 */
	public function popEvents() {
		$events = $this->events;
		$this->events = [];
		return $events;
	}

	/**
	 * @param EventArgs $event
	 */
	protected function raise(EventArgs $event) {
		$this->events[] = $event;
	}

}
