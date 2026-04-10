<?php

namespace Interpreter;

$context = [
    'isVIP' => true,
    'hasMoney' => false
];

// получить значение
function getValue($key, $context) {
    return $context[$key] ?? false;
}

// переменная (ВАЖНО: не называем var)
function variable($name) {
    return function($context) use ($name) {
        return getValue($name, $context);
    };
}

// AND
function _and($a, $b) {
    return function($context) use ($a, $b) {
        return $a($context) && $b($context);
    };
}

// OR
function _or($a, $b) {
    return function($context) use ($a, $b) {
        return $a($context) || $b($context);
    };
}

// ===== сборка выражения =====

$expr =
    _or(
        _and(
            variable('isVIP'),
            variable('hasMoney')
        ),
        variable('isVIP')
    );

// ===== выполнение =====

$result = $expr($context);

var_dump($result); // true