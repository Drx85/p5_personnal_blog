<?php


class Message
{
	public const CREATED = 'Compte créé avec succès. Vous pouvez <a href = "index.php?p=connection&action=showConnection">Vous connecter</a>';
	public const CONNECTED = 'Connection effectuée avec succès.';
	public const BAD_CREDENTIALS = 'Mauvais nom d\'utilisateur ou mot de passe.';
	public const PSEUDO_MAIL_EXISTS = 'Ce pseudo et cet email existent déjà.';
	public const PSEUDO_EXISTS = "Ce pseudo existe déjà.";
	public const MAIL_EXISTS = "Cet email existe déjà.";
}