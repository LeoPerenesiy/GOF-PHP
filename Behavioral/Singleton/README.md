# Singleton Pattern

## Purpose
Ensure a class has **only one instance** and provide a **global access point** to it.

## Problem it solves
- Guarantees a single object for coordinating actions, e.g., logger, configuration, or database connection.
- Prevents inconsistent state or wasted resources caused by multiple instances.

## How it works
1. **Private constructor** prevents direct instantiation.
2. **Static method** returns the single instance.
3. Optionally, prevent cloning (`__clone`) and deserialization (`__wakeup`).

## Example Usage
```php
$instance = Singleton::getInstance();
$instance->doSomething();