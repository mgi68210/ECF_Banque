<?php

function isConnected(): bool {
    return isset($_SESSION['user_id']);
}

function isAdmin(): bool {
    return isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
}
