<?php


class Message
{
	public const CREATED = 'Compte créé avec succès. Vous pouvez <a href = "index.php?controller=account&action=showConnection">Vous connecter</a>';
	public const CONNECTED = 'Connection effectuée avec succès.';
	public const DISCONNECTED = 'Déconnection effectuée avec succès.';
	public const BAD_CREDENTIALS = 'Mauvais nom d\'utilisateur ou mot de passe.';
	public const ALREADY_TAKEN = 'Ce pseudo ou cet email existe(nt) déjà.';
	public const ADDED = "Le billet a bien été ajouté.";
	public const SENT_COMMENT = "Votre commentaire a bien été envoyé et a été soumis pour validation, il sera publié d'ici peu.";
	public const VALIDATED_COMMENT = "Le commentaire a bien été validé et publié.";
	public const EDITED = "Le billet a bien été modifié.";
	public const DELETED_POST = "Le billet a bien été supprimé.";
	public const DELETED_COMMENT = "Le commentaire a bien été supprimé.";
	public const SENT_MAIL = "Votre email a bien été envoyé.";
	public const UNDEFINED_COMMENT = "Ce commentaire n'existe pas.";
	public const UNDEFINED_POST = "Ce billet n'existe pas.";
}