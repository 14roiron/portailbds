<?php

namespace BDS\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class BDSUserBundle extends Bundle
{
	public function getParent()
	{
		return 'FOSUserBundle';
	}
}
