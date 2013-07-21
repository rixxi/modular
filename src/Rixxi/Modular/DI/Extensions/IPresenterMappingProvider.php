<?php

namespace Rixxi\Modular\DI\Extensions;


interface IPresenterMappingProvider
{

	/**
	 * Returns array of ClassNameMask => PresenterNameMask
	 * @see https://github.com/nette/nette/blob/master/Nette/Application/PresenterFactory.php#L138
	 * @return array
	 */
	function getPresenterMapping();

}
