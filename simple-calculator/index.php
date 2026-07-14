<?php

$num1 = '';
$num2 = '';
$operator = '+';
$result = null;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $num1 = $_POST['num1'] ?? '';
    $num2 = $_POST['num2'] ?? '';
    $operator = $_POST['operator'] ?? '+';

    if (!is_numeric($num1) || !is_numeric($num2)) {
        $error = 'Please enter valid numbers in both fields.';
    } else {
        $num1 = (float) $num1;
        $num2 = (float) $num2;

        switch ($operator) {
            case '+':
                $result = $num1 + $num2;
                break;
            case '-':
                $result = $num1 - $num2;
                break;
            case '*':
                $result = $num1 * $num2;
                break;
            case '/':
                if ($num2 == 0) {
                    $error = 'Cannot divide by zero.';
                } else {
                    $result = $num1 / $num2;
                }
                break;
            default:
                $error = 'Please choose a valid operator.';
        }
    }
}

function op_label(string $operator): string
{
    return match ($operator) {
        '+' => 'Addition',
        '-' => 'Subtraction',
        '*' => 'Multiplication',
        '/' => 'Division',
        default => 'Unknown',
    };
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Simple Calculator</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f6f8;
            display: flex;
            justify-content: center;
            padding-top: 60px;
        }
        .calculator {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            padding: 32px;
            width: 320px;
        }
        h1 {
            font-size: 20px;
            margin-top: 0;
            text-align: center;
        }
        label {
            display: block;
            margin-top: 12px;
            font-size: 14px;
            color: #333;
        }
        input[type="text"],
        select {
            width: 100%;
            padding: 8px;
            margin-top: 4px;
            box-sizing: border-box;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            width: 100%;
            margin-top: 20px;
            padding: 10px;
            background: #2563eb;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background: #1d4ed8;
        }
        .result, .error {
            margin-top: 20px;
            padding: 12px;
            border-radius: 4px;
            font-size: 15px;
            text-align: center;
        }
        .result {
            background: #ecfdf5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }
        .error {
            background: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }
    </style>
</head>
<body>
    <div class="calculator">
        <h1>Simple Calculator</h1>

        <?php if ($error !== ''): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php elseif ($result !== null): ?>
            <div class="result">
                <?= op_label($operator) ?> result:
                <strong><?= htmlspecialchars((string) $result) ?></strong>
            </div>
        <?php endif; ?>

        <form method="post">
            <label for="num1">First number</label>
            <input type="text" id="num1" name="num1" value="<?= htmlspecialchars((string) $num1) ?>" required>

            <label for="operator">Operation</label>
            <select id="operator" name="operator">
                <option value="+" <?= $operator === '+' ? 'selected' : '' ?>>+ Addition</option>
                <option value="-" <?= $operator === '-' ? 'selected' : '' ?>>&minus; Subtraction</option>
                <option value="*" <?= $operator === '*' ? 'selected' : '' ?>>&times; Multiplication</option>
                <option value="/" <?= $operator === '/' ? 'selected' : '' ?>>&divide; Division</option>
            </select>

            <label for="num2">Second number</label>
            <input type="text" id="num2" name="num2" value="<?= htmlspecialchars((string) $num2) ?>" required>

            <button type="submit">Calculate</button>
        </form>
    </div>
</body>
</html>
