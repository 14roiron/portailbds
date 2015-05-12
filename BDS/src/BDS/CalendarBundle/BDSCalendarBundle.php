<?php

namespace BDS\CalendarBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class BDSCalendarBundle extends Bundle
{
	public function getParent()
	{
		return 'BladeTesterCalendarBundle';
	}
}
