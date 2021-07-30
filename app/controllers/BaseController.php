<?php


namespace Controllers;


class BaseController extends Controller
{
	/**
	 * Render forbidden page with status 403 Forbidden
	 *
	 * @throws \Twig\Error\LoaderError
	 * @throws \Twig\Error\RuntimeError
	 * @throws \Twig\Error\SyntaxError
	 */
	public function forbidden(): void
	{
		header('HTTP/1.0 403 Forbidden');
		echo $this->twig->render('forbidden.twig');
	}
	
	/**
	 * Render not found page with status 404 Not Found
	 *
	 * @throws \Twig\Error\LoaderError
	 * @throws \Twig\Error\RuntimeError
	 * @throws \Twig\Error\SyntaxError
	 */
	public function show404(): void
	{
		header('HTTP/1.0 404 Not Found');
		echo $this->twig->render('404.twig');
	}
	
	/**
	 * To know if an user has the admin or publisher role
	 *
	 * @return bool
	 */
	protected function hasPermission(): bool
	{
		if ($this->role === 'admin' || $this->role === 'publisher') {
			return true;
		}
		return false;
	}
}
