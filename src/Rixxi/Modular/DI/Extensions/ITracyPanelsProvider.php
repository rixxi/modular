<?php

namespace Rixxi\Modular\DI\Extensions;


interface ITracyPanelsProvider
{

	/**
	 * Returns array of panel renderer callbacks
	 * @see http://doc.nette.org/cs/configuring#toc-debugger
	 * @return array
	 */
	function getTracyPanels();

}