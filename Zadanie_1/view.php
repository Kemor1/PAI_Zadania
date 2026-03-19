<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator Kredytowy</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f9; display: flex; justify-content: center; padding: 50px; }
        .calculator-box { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); width: 100%; max-width: 400px; }
        h2 { text-align: center; color: #333; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; color: #555; }
        input[type="number"], select { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background-color: #007bff; color: white; border: none; border-radius: 4px; font-size: 16px; cursor: pointer; }
        button:hover { background-color: #0056b3; }
        .errors { background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 4px; margin-bottom: 15px; }
        .errors ul { margin: 0; padding-left: 20px; }
        .result { background-color: #d4edda; color: #155724; padding: 15px; border-radius: 4px; margin-top: 20px; text-align: center; font-size: 16px; border: 1px solid #c3e6cb; line-height: 1.5;}
    </style>
</head>
<body>

<div class="calculator-box">
    <h2>Kalkulator Kredytowy</h2>

    <?php if (!empty($errors)): ?>
        <div class="errors">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo htmlspecialchars($error); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if ($result !== null && $totalAmount !== null): ?>
        <div class="result">
            Miesięczna rata: <strong><?php echo number_format($result, 2, ',', ' '); ?> zł</strong><br>
            Całkowita kwota do spłaty: <strong><?php echo number_format($totalAmount, 2, ',', ' '); ?> zł</strong>
        </div>
    <?php endif; ?>

    <form action="index.php" method="POST">
        <div class="form-group">
            <label for="amount">Kwota kredytu (zł):</label>
            <input type="number" step="0.01" name="amount" id="amount" value="<?php echo htmlspecialchars($amount ?? ''); ?>" placeholder="np. 10000">
        </div>

        <div class="form-group">
            <label for="months">Okres kredytowania (miesiące):</label>
            <input type="number" name="months" id="months" value="<?php echo htmlspecialchars($months ?? ''); ?>" placeholder="np. 24">
        </div>

        <div class="form-group">
            <label for="interest">Oprocentowanie roczne:</label>
            <select name="interest" id="interest">
                <option value="">-- Wybierz procent --</option>
                <option value="5" <?php echo ($interest == '5') ? 'selected' : ''; ?>>5%</option>
                <option value="8" <?php echo ($interest == '8') ? 'selected' : ''; ?>>8%</option>
                <option value="10" <?php echo ($interest == '10') ? 'selected' : ''; ?>>10%</option>
                <option value="12" <?php echo ($interest == '12') ? 'selected' : ''; ?>>12%</option>
                <option value="15" <?php echo ($interest == '15') ? 'selected' : ''; ?>>15%</option>
                <option value="20" <?php echo ($interest == '20') ? 'selected' : ''; ?>>20%</option>
            </select>
        </div>

        <button type="submit">Oblicz ratę</button>
    </form>
</div>

</body>
</html>
