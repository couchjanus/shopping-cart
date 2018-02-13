<?php


$string = 'posts/1';

echo preg_match("#[\w]+\/[0-9]#", $string, $matches);

echo "\n";

print_r($matches);

echo "\n";


$pattern = preg_replace('#\(/\)#', '/?', $string);

print_r($pattern);

echo "\n";

$pattern = preg_replace('/{([0-9]+)}/', '(?<$1>[0-9]+)', $pattern);

print_r($pattern);

echo "\n";
$uri = 'admin/posts/1';
$key = 'admin/posts/{id}';

$pattern = preg_replace('#\(/\)#', '/?', $uri);
echo $pattern;
echo "\n";

$pattern = preg_replace('#\(/\)#', '/?', $key);
echo $pattern;
echo "\n";

$pattern = "@^" .preg_replace('/{([a-zA-Z0-9\_\-]+)}/', '(?<$1>[a-zA-Z0-9\_\-]+)', $pattern). "$@D";
echo $pattern;
echo "\n";
echo preg_match($pattern, $uri, $matches);
echo "\n";
print_r($matches);
echo "\n";
// array_shift($matches);
print_r(array_shift($matches));
echo "\n";
print_r($matches);
echo "\n";

?>