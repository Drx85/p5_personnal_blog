<?php


class Message
{
	public const CREATED = 'Compte créé avec succès. Vous pouvez <a href = "index.php?controller=user&action=showConnection">Vous connecter</a>';
	public const CONNECTED = 'Connection effectuée avec succès.';
	public const DISCONNECTED = 'Déconnection effectuée avec succès.';
	public const BAD_CREDENTIALS = 'Mauvais nom d\'utilisateur ou mot de passe.';
	public const ALREADY_TAKEN = 'Ce pseudo ou cet email existe(nt) déjà.';
	public const ADDED = "Le billet a bien été ajouté.";
	public const SENT_COMMENT = "Votre commentaire a bien été envoyé et a été soumis pour validation, il sera publié d'ici peu.";
	public const VALIDATED_COMMENT = "Le commentaire a bien été validé et publié.";
	public const EDITED = "Le billet a bien été modifié.";
	public const DELETED_CONTENT = "Le contenu a bien été supprimé.";
	public const SENT_MAIL = "Votre email a bien été envoyé.";
	public const UNDEFINED_CONTENT = "Ce billet ou ce commentaire n'existe pas.";
	public const TITLE_ALREADY_EXISTS = "Ce titre existe déjà.";
	public const UPDATED_USER = "Le role de l'utilisateur a bien été modifié";
	public const UNDEFINED_USER = "Cet utilisateur n'existe pas.";
}