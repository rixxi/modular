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
		foreach ($this->compiler->getExtensions() as $extension) {
			if ($extension instanceof $interfaceOrClass) {
				return $extension;
			}
		}

		throw new Nette\Utils\AssertionException("Please register the required $interfaceOrClass to Compiler.");
	}


	/**
	 * @param string $interfaceOrClass
	 * @return Nette\DI\CompilerExtension[]
	 */
	private function getCompilerExtensions($interfaceOrClass)
	{
		$extensions = [];
		foreach ($this->compiler->getExtensions() as $extension) {
			if ($extension instanceof $interfaceOrClass) {
				$extensions[] = $extension;
			}
		}
		return $extensions;
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