<?php

namespace Rixxi\Modular\DI;

use Nette;
use Nette\Utils\Validators;


/**
 * Trait only purpose is to remove unused
 */
trait CompilerExtensionSugar
{

	/**
	 * @param string $interfaceOrClass
	 * @return Nette\DI\CompilerExtension
	 * @throws Nette\Utils\AssertionException
	 */
	private function getCompilerExtension($interfaceOrClass)
	{
		if ($extensions = $this->compiler->getExtensions($interfaceOrClass)) {
			return reset($extensions);
		}

		throw new Nette\Utils\AssertionException("Please register the required $interfaceOrClass to Compiler.");
	}


	/**
	 * @deprecated
	 * @param string $interfaceOrClass
	 * @return Nette\DI\CompilerExtension[]
	 */
	private function getCompilerExtensions($interfaceOrClass)
	{
		trigger_error('getCompilerExtensions($interfaceOrClass) is deprecated call $this->compiler->getExtensions($type) instead.', E_USER_DEPRECATED);
		return $this->compiler->getExtensions($interfaceOrClass);
	}


	/**
	 * Load __DIR__/config/$name.neon services with prefix $name
	 * @param string $name
	 * @author Filip Procházka (filip@prochazka.su)
	 * @see copy of package Kdyby/Doctrine class Kdyby\Doctrine\DI\OrmExtension function loadConfig code :)
	 */
	private function loadConfig($name)
	{
		$this->compiler->parseServices(
			$this->getContainerBuilder(),
			$this->loadFromFile(dirname($this->getReflection()->getFileName()) . '/config/' . $name . '.neon'),
			$this->prefix($name)
		);
	}

}
