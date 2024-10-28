<?php

class Router
{
    private array $routes;

    public function __construct(array $routes)
    {
        $this->routes = $routes;
        $this->dispatchRoute($this->getRequestUri());
    }

    private function getRequestUri(): string
    {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '/';
    }

    private function dispatchRoute(string $uri): void
    {
        if (isset($this->routes[$uri])) {
            $route = $this->routes[$uri];

            $this->redirectIfProtected($route);
            $this->redirectIfLoggedInAndOnPublicPage($uri);
            $this->checkUserRole($route);

            require $route['path'];
        } else {
            $this->dispatchError();
        }
    }

    private function checkUserRole(array $route): void
    {
        if (isset($route['role']) && AuthService::getUserRole() !== $route['role']) {
            header("Location: /");
            exit;
        }
    }

    private function redirectIfProtected(array $route): void
    {
        if (!empty($route['protected']) && !AuthService::isLoggedIn()) {
            header("Location: /login");
            exit;
        }
    }

    private function redirectIfLoggedInAndOnPublicPage(string $uri): void
    {
        if (empty($route['protected']) && AuthService::isLoggedIn() && ($uri === '/login' || $uri === '/register')) {
            header("Location: /");
            exit;
        }
    }

    public function isLoggedIn(): bool
    {
        return isset($_SESSION['user_id']);
    }

    public function getRoutes(): array
    {
        return $this->routes;
    }

    public function dispatchError($code = 404): void
    {
        http_response_code($code);
        $errorView = "views/{$code}.php";

        if (file_exists($errorView)) {
            require $errorView;
        }

        exit;
    }
}
