<?php
class Controller {
    public function view($view, $data = []) {
        $data['baseUrl'] = BASE_URL;
        extract($data);
        require_once __DIR__ . '/../views/' . $view . '.php';
    }
}
    