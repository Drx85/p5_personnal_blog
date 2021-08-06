<?php

namespace Controllers;

class Page extends Controller
{
	/**
	 * @var string
	 */
	protected $modelName = \Models\Post::class;
	
	/**
	 * Render homepage
	 *
	 * @throws \Twig\Error\LoaderError
	 * @throws \Twig\Error\RuntimeError
	 * @throws \Twig\Error\SyntaxError
	 */
	public function showHome(): void
	{
		echo $this->twig->render('home.twig');
	}
	
	/**
	 * Render Add new post form
	 * Require admin or publisher role
	 *
	 * @throws \Twig\Error\LoaderError
	 * @throws \Twig\Error\RuntimeError
	 * @throws \Twig\Error\SyntaxError
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
	 * @throws \Twig\Error\LoaderError
	 * @throws \Twig\Error\RuntimeError
	 * @throws \Twig\Error\SyntaxError
	 */
	public function showEdit(): void
	{
		if ($this->hasRoles(['admin', 'publisher'])) {
			$value = $this->model->getEditValues((int)filter_input(INPUT_GET, 'id'));
			echo $this->twig->render('edit_post.twig', compact('value'));
		} else {
			$this->forbidden();
		}
	}
	
	/**
	 * Render CGU page
	 *
	 * @throws \Twig\Error\LoaderError
	 * @throws \Twig\Error\RuntimeError
	 * @throws \Twig\Error\SyntaxError
	 */
	public function showCgu(): void
	{
		echo $this->twig->render('cgu.twig');
	}
}