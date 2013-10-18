<?php

namespace Rixxi\Modular\DI;


interface IRouterProvider
{

	/**
	 * Returns array of service names,
	 * that will be appended to setup of router service
	 * @return array[]
	 */
	public function getRouters();

}
