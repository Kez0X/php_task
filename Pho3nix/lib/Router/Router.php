<?php

namespace Router;
require dirname(__DIR__, 2) . '/config/routes.php';

// Documentation : https://laconsole.dev/formations/framework-php/routage
class Router {
    private array $routes;
    private string $requestedPath;
    private string $method;

    public function __construct() {
        $this->routes = ROUTES;
        $this->requestedPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
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
    
        // On décompose la route demandée
        $explodedRequestedPath = $this->explodePath($this->requestedPath);
        $params = [];
    
        // On parcourt toutes les routes possibles
        foreach ($this->routes[$this->method] as $candidatePath => $route) {
            // On décompose la route candidate
            $explodedCandidatePath = $this->explodePath($candidatePath);
            
            // Si le nombre de segments dans la route candidate et la route demandée est le même
            if (count($explodedCandidatePath) === count($explodedRequestedPath)) {
                $foundMatch = true;
                
                // On compare chaque segment des deux chemins
                foreach ($explodedRequestedPath as $key => $requestedPathPart) {
                    $candidatePathPart = $explodedCandidatePath[$key];
                    
                    // Si c'est un paramètre, on le récupère et on l'ajoute aux paramètres
                    if ($this->isParam($candidatePathPart)) {
                        $params[trim($candidatePathPart, '{}')] = $requestedPathPart;
                    }
                    // Si ce n'est pas un paramètre et que les segments ne correspondent pas
                    elseif ($candidatePathPart !== $requestedPathPart) {
                        $foundMatch = false;
                        break;
                    }
                }
                
                // Si on a trouvé une correspondance, on exécute la méthode du contrôleur
                if ($foundMatch) {
                    $controller = new $route['controller'];
                    $controller->{$route['method']}(...$params);
                    return; // On arrête la recherche si la route est trouvée
                }
            }
        }
    
        // Si aucune route n'est trouvée, on retourne une erreur 404
        http_response_code(404);
        echo "404 Not Found";
    }
    
}

?>