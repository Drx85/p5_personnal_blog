<?php


class Config
{
//	Database
	public const DB_HOST = 'localhost';
	public const DB_PORT = '3308';
	public const DB_USERNAME = 'root';
	public const DB_PASSWORD = '';
	public const DB_NAME = 'blog';
	
//	SMTP
	public const MAIL_HOST = 'mail.infomaniak.com';
	public const MAIL_PORT = '465';
	public const MAIL_USERNAME = 'cedric@deperne.fr';
	public const MAIL_PASSWORD = '4iu6uJdAJkZxW3i';
	
//	Options
	public const NB_POSTS_PER_PAGE = 6;
	public const CACHE = false;
	public const DEBUG = true;
}