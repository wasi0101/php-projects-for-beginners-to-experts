# Simple Calculator

A basic web-based calculator that performs addition, subtraction, multiplication, and division. Available in two versions:

- **`index.php`** — server-side version using plain PHP and a classic self-submitting HTML form (no JavaScript).
- **`calculator.html`** — static client-side version using plain JavaScript. Requires no server; just open the file directly in a browser.

## Features
- Addition, subtraction, multiplication, and division
- Input validation for non-numeric values
- Friendly error message on divide-by-zero
- Form re-populates the previously entered values after submitting (PHP version)

## Running the PHP version
Requires PHP 8.0+. From the repository root:

```bash
php -S localhost:8000 -t simple-calculator
```

Then open http://localhost:8000 in your browser.

## Running the HTML version
No server or dependencies needed — just open `calculator.html` directly in any web browser.
