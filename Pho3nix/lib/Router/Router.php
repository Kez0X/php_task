<?php

namespace Pho3nix\lib\Router;
require dirname(__DIR__, 2) . '/config/routes.php';

// Documentation : https://laconsole.dev/formations/framework-php/routage
class Router {
    private array $routes;
    private string $requestedPath;
    private string $method;

    public function __construct() {
        echo "Le routeur fonctionne !";
        $this->routes = ROUTES;
        $this->requestedPath = isset($_GET['path']) ? $_GET['path'] : '/';
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->parseRoutes();
    }

    private function explodePath(string $path): array {
        return explode('/', trim($path, '/'));
    }

    private function isParam(string $pathPart): bool {
        return str_contains($pathPart, '{') && str_contains($pathPart, '}');
    }

    private function parseRoutes(): void {
        if (!isset($this->routes[$this->method])) {
            http_response_code(405); // Méthode non autorisée
            echo "405 Method Not Allowed";
            exit;
        }

        $explodedRequestedPath = $this->explodePath($this->requestedPath);
        $params = [];

        foreach ($this->routes[$this->method] as $candidatePath => $route) {
            $explodedCandidatePath = $this->explodePath($candidatePath);
            if (count($explodedCandidatePath) === count($explodedRequestedPath)) {
                $foundMatch = true;
                foreach ($explodedRequestedPath as $key => $requestedPathPart) {
                    $candidatePathPart = $explodedCandidatePath[$key];
                    if ($this->isParam($candidatePathPart)) {
                        $params[trim($candidatePathPart, '{}')] = $requestedPathPart;
                    } elseif ($candidatePathPart !== $requestedPathPart) {
                        $foundMatch = false;
                        break;
                    }
                }
                if ($foundMatch) {
                    $controller = new $route['controller'];
                    $controller->{$route['method']}(...$params);
                    return;
                }
            }
        }

        http_response_code(404);
        echo "404 Not Found";
    }
}

?>