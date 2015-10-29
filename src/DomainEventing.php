<?php

namespace Esports\DomainEvents;

use Doctrine\Common\EventArgs;

/**
 * Rozhrani pro domenovy objekt produkujici eventy
 */
interface DomainEventing {

	/**
	 * @return EventArgs[]
	 */
	public function popEvents();

}
