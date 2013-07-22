<?php

namespace Rixxi\Modular\DI;


interface ITracyBarPanelsProvider
{

	/**
	 * Returns array of classes or services that will be configured to bar panels
	 * @see http://doc.nette.org/cs/configuring#toc-debugger
	 * @return array
	 */
	function getTracyBarPanels();

}