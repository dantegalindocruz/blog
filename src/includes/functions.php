<?php
function redirect(string $location, array $parameters = [], $response_code = 302)
{
    $query_string = $parameters ? '?' . http_build_query($parameters) : ''; // create query string 
    $location = $location . $query_string;
    header('Location: ' . $location, $response_code);
    exit;
};

//Validate text length
function is_text(string $text, int $min = 0, int $max = 1000) : bool 
{
    $length = mb_strlen($text);
    return ($length >= $min and $length <= $max);
}
?>