<?php

namespace Controllers;

use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class Page extends Controller
{
	/**
	 * @var string
	 */
	protected $managerName = \Managers\Post::class;
	
	/**
	 * Render homepage
	 *
	 * @throws LoaderError
	 * @throws RuntimeError
	 * @throws SyntaxError
	 */
	public function showHome(): void
	{
		echo $this->twig->render('home.twig');
	}
	
	/**
	 * Render Add new post form
	 * Require admin or publisher role
	 *
	 * @throws LoaderError
	 * @throws RuntimeError
	 * @throws SyntaxError
	 */
	public function showAdd(): void
	{
		if ($this->hasRoles(['admin', 'publisher'])) {
			echo $this->twig->render('add_post.twig');
		} else {
			$this->forbidden();
		}
	}
	
	/**
	 * Render Edit post form
	 * Require admin or publisher role
	 *
	 * @throws LoaderError
	 * @throws RuntimeError
	 * @throws SyntaxError
	 */
	public function showEdit(): void
	{
		if ($this->hasRoles(['admin', 'publisher'])) {
			$id = (int)filter_input(INPUT_GET, 'id');
			$post = new \Entities\Post(compact('id'));
			$post = $this->manager->getEditValues($post);
			echo $this->twig->render('edit_post.twig', compact('post'));
		} else {
			$this->forbidden();
		}
	}
	
	/**
	 * Render CGU page
	 *
	 * @throws LoaderError
	 * @throws RuntimeError
	 * @throws SyntaxError
	 */
	public function showCgu(): void
	{
		echo $this->twig->render('cgu.twig');
	}
	
	/**
	 * Render Sitemap page
	 *
	 * @throws LoaderError
	 * @throws RuntimeError
	 * @throws SyntaxError
	 */
	public function showSitemap(): void
	{
		echo $this->twig->render('sitemap.twig');
	}
}