<?php
// Maxence Persello

require_once 'php/bibli_generale.php';

require_once 'controllers/indexController.php';
require_once 'controllers/userController.php';
require_once 'controllers/qcmController.php';
require_once 'controllers/authController.php';

$route = isset($_GET['route']) ? $_GET['route'] : '';
$admin = (isset($_SESSION['usAdmin']) && $_SESSION['usAdmin']) ? 1 : 0;

switch ($route) {
    case 'gestion_user':
        if($admin) {
            userController();
            break;
        } else {
            header('Location: #');
        }
    case 'edit_user':
        if($admin) {
            userEditor(isset($_GET['id'])?$_GET['id']:0);
            break;
        } else {
            header('Location: #');
        }
    case 'auth':
        authController();
        break;
    case 'questionnaires':
        qcmController();
        break;
    default:
        indexController();
        break;
}