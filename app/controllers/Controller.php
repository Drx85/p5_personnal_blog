<?php

namespace Controllers;

abstract class Controller
{
	protected $post;
	protected $pages;
	protected $account;
	protected $comment;
	protected $admin;
	
	public function __construct()
	{
		$this->post = new \Models\Post();
		$this->pages = new \Models\Page();
		$this->account = new \Models\Account();
		$this->comment = new \Models\Comment();
		$this->admin = new \Models\Admin();
	}
}