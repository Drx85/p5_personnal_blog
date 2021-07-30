<?php


use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Extra\Markdown\DefaultMarkdown;
use Twig\Extra\Markdown\MarkdownExtension;
use Twig\Extra\Markdown\MarkdownRuntime;
use Twig\Extra\String\StringExtension;
use Twig\Loader\FilesystemLoader;
use Twig\RuntimeLoader\RuntimeLoaderInterface;
use Twig\TwigFilter;
use Twig\TwigFunction;

class TwigLoader
{
	public $twig;
	/**
	 * Loader Twig and its extensions/functions/filters
	 *
	 * @return Object $twig
	 */
	public function __construct()
	{
		$loader = new FilesystemLoader('views');
		$this->twig = new Environment($loader, [
			'cache' => false,
			'debug' => true
		]);
		$this->twig->addGlobal('session', $_SESSION);
		$this->twig->addExtension(new DebugExtension());
		$this->twig->addExtension(new StringExtension());
		$this->twig->addExtension(new MarkdownExtension());
		$this->twig->addFilter(new TwigFilter('trans', function ($value) {
			return \Translation::translate($value);
		}));
		$this->twig->addFunction(new TwigFunction('csrf_token', function () {
			return \AntiCsrf::createToken();
		}));
		
		$this->twig->addRuntimeLoader(new class implements RuntimeLoaderInterface {
			public function load($class)
			{
				if (MarkdownRuntime::class === $class) {
					return new MarkdownRuntime(new DefaultMarkdown());
				}
			}
		});
	}
	
	/**
	 * Return twig with its extensions/functions/filters
	 *
	 * @return Environment
	 */
	public function getTwig()
	{
		return $this->twig;
	}
}