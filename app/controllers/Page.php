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
			$id = (int)filter_input(INPUT_GET, 'id');
			$post = new \Entities\Post();
			$post->setId($id);
			$post = $this->model->getEditValues($post);
			echo $this->twig->render('edit_post.twig', compact('post'));
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