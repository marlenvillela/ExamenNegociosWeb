<?php


namespace Views;


class Renderer
{
    public static function render(string $view, array $data = []): void
    {
        $viewFile = __DIR__ . '/' . $view . '.view.tpl';


        if (!file_exists($viewFile)) {
            http_response_code(500);
            die("Vista no encontrada: " . htmlspecialchars($view));
        }


        // Convertir el arreglo de datos en variables
        extract($data);


        // Motor de plantillas simple {{variable}}
        $content = file_get_contents($viewFile);


        foreach ($data as $key => $value) {
            if (!is_array($value)) {
                $content = str_replace('{{' . $key . '}}', htmlspecialchars((string)$value), $content);
            }
        }


        // Manejo básico de foreach
        $content = preg_replace_callback(
            '/\{\{foreach (\w+)\}\}([\s\S]*?)\{\{endfor \1\}\}/',
            function ($matches) use ($data) {
                $items = $data[$matches[1]] ?? [];
                $block = '';


                foreach ($items as $item) {
                    $row = $matches[2];
                    foreach ($item as $k => $v) {
                        $row = str_replace('{{' . $k . '}}', htmlspecialchars((string)$v), $row);
                    }
                    $block .= $row;
                }


                return $block;
            },
            $content
        );


        echo $content;
    }
}


