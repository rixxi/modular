<?php

namespace Rixxi\Modular\DI\Extensions;


interface IRouterProvider
{

	/**
	 * Returns array of ServiceDefinition,
	 * that will be appended to setup of router service
	 * @return array[]
	 */
	function getRouterDefinitions();

}