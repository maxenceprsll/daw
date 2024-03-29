<?php // Maxence Persello

require_once 'php/bibli_generale.php';

require_once 'controllers/indexController.php';
require_once 'controllers/userController.php';
require_once 'controllers/forumController.php';
require_once 'controllers/qcmController.php';
require_once 'controllers/coursController.php';
require_once 'controllers/authController.php';
require_once 'controllers/profilController.php';
require_once 'controllers/errorController.php';


$route = isset($_GET['route']) ? $_GET['route'] : '';
$loggedin = (isset($_SESSION['usLogin']));
$admin = ($loggedin && $_SESSION['usAdmin']);

switch ($route) {
    case 'gestion_user':
        if($admin) {
            userController();
            break;
        } else {
            header('Location: ?');
        }
    case 'edit_user':
        if($admin) {
            userEditor(isset($_GET['id'])?$_GET['id']:0);
            break;
        } else {
            header('Location: ?');
        }
    case 'remove_user':
        if($admin) {
            userRemove(isset($_GET['id'])?$_GET['id']:0);
            break;
        } else {
            header('Location: ?');
        }
    case 'add_user':
        if($admin) {
            userAdd();
            break;
        } else {
            header('Location: ?');
        }
    case 'auth':
        authController();
        break;
    case 'profil':
        profilController();
        break;
    case 'questionnaires':
        qcmController();
        break;
    case 'forum':
        forumController();
        break;
    case 'cours':
        coursController();
        break;
    case 'remove_page':
        if($admin) {
            coursRemover(isset($_GET['id'])?$_GET['id']:0);
            break;
        } else {
            header('Location: ?');
        }
    case '':
    case 'index':
        indexController();
        break;
    default:
        errorController();
        break;
}