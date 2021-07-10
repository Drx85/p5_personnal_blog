<?php


class Message
{
	public const CREATED = 'Compte créé avec succès. Vous pouvez <a href = "index.php?p=connection&action=showConnection">Vous connecter</a>';
	public const CONNECTED = 'Connection effectuée avec succès.';
	public const DISCONNECTED = 'Déconnection effectuée avec succès.';
	public const BAD_CREDENTIALS = 'Mauvais nom d\'utilisateur ou mot de passe.';
	public const PSEUDO_MAIL_EXISTS = 'Ce pseudo et cet email existent déjà.';
	public const PSEUDO_EXISTS = "Ce pseudo existe déjà.";
	public const MAIL_EXISTS = "Cet email existe déjà.";
	public const ADDED = "Le billet a bien été ajouté.";
	public const EDITED = "Le billet a bien été modifié.";
	public const DELETED_POST = "Le billet a bien été supprimé.";
	public const DELETED_COMMENT = "Le commentaire a bien été supprimé.";
}