<?php

/**
 * Cette fonction me permet de savoir si un utilisateur est actuellement connecté.
 * Je regarde simplement si la session contient une clé 'user_id'.
 */
function isConnected(): bool {
    // Si l'identifiant de l'utilisateur est présent dans la session, alors il est connecté
    return isset($_SESSION['user_id']);
}

/**
 * Cette fonction me permet de vérifier si l'utilisateur connecté est un administrateur.
 * Je vérifie que la session contient une clé 'user_role' avec la valeur "admin".
 */
function isAdmin(): bool {
    // Je retourne vrai seulement si le rôle est bien "admin"
    return isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
}

/**
 * Cette fonction me permet de vérifier si l'utilisateur est un "vrai utilisateur" (et non un admin).
 * Elle est utile pour filtrer l’accès aux zones réservées aux utilisateurs clients.
 */
function isRealUser(): bool {
    // Je retourne vrai seulement si le rôle enregistré est "user"
    return isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'user';
}
