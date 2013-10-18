<?php

namespace Rixxi\Modular\DI;

use Nette;
use Nette\Utils\Validators;


class ModularExtension extends Nette\DI\CompilerExtension
{

	public function loadConfiguration()
	{
		$container = $this->getContainerBuilder();

		$presenterFactory = $container->getDefinition('nette.presenterFactory');
		$router = $container->getDefinition('router');

		foreach ($this->compiler->getExtensions() as $extension) {
			if ($extension instanceof IPresenterMappingProvider) {
				if ($mapping = $extension->getPresenterMapping()) {
					$presenterFactory->addSetup('setMapping', array($mapping));
				}
			}

			if ($extension instanceof IRouterProvider) {
				foreach ($extension->getRouters() as $service) {
					$router->addSetup('offsetSet', array(NULL, $service));
				}
			}
		}

		return $this->getConfig();
	}


	public function afterCompile(Nette\PhpGenerator\ClassType $class)
	{
		$container = $this->getContainerBuilder();

		if ($container->parameters['debugMode']) {
			$initialize = $class->methods['initialize'];

			foreach ($this->compiler->getExtensions() as $extension) {
				if ($extension instanceof ITracyBarPanelsProvider) {
					foreach ($extension->getTracyBarPanels() as $item) {
						$initialize->addBody($container->formatPhp(
							'Nette\Diagnostics\Debugger::getBar()->addPanel(?);',
							Nette\DI\Compiler::filterArguments(array(is_string($item) ? new Nette\DI\Statement($item) : $item))
						));
					}
				}

				if ($extension instanceof ITracyPanelsProvider) {
					foreach ($extension->getTracyPanels() as $item) {
						$initialize->addBody($container->formatPhp(
							'Nette\Diagnostics\Debugger::getBlueScreen()->addPanel(?);',
							Nette\DI\Compiler::filterArguments(array($item))
						));
					}
				}
			}
		}
	}

}
