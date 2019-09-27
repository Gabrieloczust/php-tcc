<?php
class logoutController extends Controller
{
    public function index()
    {
        unset($_SESSION['user']);
        session_destroy();
        header("Location:" . HOME) . 'login';
        exit;
    }
}