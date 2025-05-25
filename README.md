# Wixy PHP SDK

[![License](https://img.shields.io/github/license/N3x74/Wixy)](LICENSE)
[![Packagist](https://img.shields.io/packagist/v/n3x74/wixy)](https://packagist.org/packages/n3x74/wixy)

Wixy is a lightweight PHP SDK for communicating with the [Nest API](https://nestcode.org/).  
It supports versioned API endpoints, built-in error handling, and clean abstraction for your HTTP requests.

---

## 🚀 Features

- Simple and clean interface
- Version-based API routing
- Error-safe JSON decoding
- Guzzle-powered HTTP client
- Composer & Git installation support

---

## 📦 Installation

### Option 1: Install via Composer

```bash
composer require n3x74/wixy
```

> Make sure Composer is installed: https://getcomposer.org

### Option 2: Clone via Git

```bash
git clone https://github.com/N3x74/Wixy.git
```

Then include it manually or use PSR-4 autoloading.

---

## 🛠 Usage

```php
require 'vendor/autoload.php'; // if using Composer

use N3x74\Wixy\Api;

$api = new Api('your_api_key_here');

$response = $api
    ->version(1) // api version
    ->get('endpoint-name', [
        'param1' => 'value1',
        'param2' => 'value2',
    ]);

print_r($response);
```

---

## 📘 Example

```php
$response = $api->version(1)->get('ChatGPT', ['q' => 'Hello']);

if ($response['status_code'] === 200) {
    $data = $response['body'];
    echo "Result: " . $data['detail']['data'] ?? 'No result';
} else {
    echo "Error: " . $response['error'];
}
```

---

## 📥 Response Format

### ✅ On success:
```php
[
    'status_code' => 200,
    'body' => [ ...parsed JSON response... ]
]
```

### ❌ On failure:
If the error response is JSON:
```php
[
    'status_code' => 400,
    'body' => [ ...parsed JSON error... ],
    'error' => 'Guzzle exception message'
]
```

If the error is plain text:
```php
[
    'status_code' => 500,
    'body' => 'Server Error',
    'error' => 'Guzzle exception message'
]
```

---

## 📚 API Versioning

To target a specific API version:

```php
$api->version(1)->get('endpoint');
$api->version(2)->get('another-endpoint');
```

Internally, the version changes the request path to:
```
https://open.wiki-api.ir/apis-{version}/{endpoint}
```

---

## ✅ Requirements

- PHP 8.0 or higher
- GuzzleHTTP 7+

---

## 📄 License

This project is open-sourced under the [MIT license](LICENSE).

---

## 🔗 Links

- 🧠 Nest API: [https://nestcode.org/](https://nestcode.org/)
- 📦 Composer: [https://packagist.org/packages/n3x74/wixy](https://packagist.org/packages/n3x74/wixy)
- 🧑‍💻 Author: [@N3x74](https://github.com/N3x74)
- ☁️ telegram: [@N3x74](https://t.me/N3x74)
