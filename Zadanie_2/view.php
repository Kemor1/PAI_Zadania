<!DOCTYPE HTML>
<html lang="pl">
    <head>
        <title>Kalkulator Kredytowy</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <link rel="stylesheet" href="assets/css/main.css" />
        <noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
    </head>
    <body class="is-preload">

        <div id="wrapper">

                <header id="header">
                        <div class="logo">
                            <span class="icon fa-calculator"></span>
                        </div>
                        <div class="content">
                            <div class="inner">
                                <h1>Kalkulator Kredytowy</h1>
                                <p>Szybko i wygodnie oblicz swoją miesięczną ratę.</p>
                            </div>
                        </div>
                        <nav>
                            <ul>
                                <li><a href="#intro">Otwórz Kalkulator</a></li>
                            </ul>
                        </nav>
                    </header>

                <div id="main">

                        <article id="intro">
                                <h2 class="major">Wprowadź dane</h2>

                                <?php if (!empty($errors)): ?>
                                    <div style="background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 4px; margin-bottom: 20px;">
                                        <ul style="margin: 0; padding-left: 20px;">
                                            <?php foreach ($errors as $error): ?>
                                                <li><?php echo htmlspecialchars($error); ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>

                                <?php if ($result !== null && $totalAmount !== null): ?>
                                    <div style="background-color: #d4edda; padding: 20px; border-radius: 4px; margin-bottom: 25px; border: 1px solid #c3e6cb; text-align: center;">
                                        <h3 style="color: #155724; margin-bottom: 10px;">Twój wynik:</h3>
                                        <p style="color: #155724; margin: 0;">
                                            Miesięczna rata: <strong style="color: #0b2e13;"><?php echo number_format($result, 2, ',', ' '); ?> zł</strong><br>
                                            Całkowita kwota do spłaty: <strong style="color: #0b2e13;"><?php echo number_format($totalAmount, 2, ',', ' '); ?> zł</strong>
                                        </p>
                                    </div>
                                <?php endif; ?>

                                <form action="index.php#intro" method="POST">
                                    <div class="fields">
                                        <div class="field half">
                                            <label for="amount">Kwota kredytu (zł):</label>
                                            <input type="text" step="0.01" name="amount" id="amount" value="<?php echo htmlspecialchars($amount ?? ''); ?>" placeholder="np. 10000" />
                                        </div>
                                        
                                        <div class="field half">
                                            <label for="months">Okres (miesiące):</label>
                                            <input type="text" name="months" id="months" value="<?php echo htmlspecialchars($months ?? ''); ?>" placeholder="np. 24" />
                                        </div>
                                        
                                        <div class="field">
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
                                    </div>
                                    
                                    <ul class="actions">
                                        <li><input type="submit" value="Oblicz ratę" class="primary" /></li>
                                    </ul>
                                </form>

                            </article>
                    </div>

                <footer id="footer">
                        <p class="copyright">&copy; Twój Kalkulator. Szablon: <a href="https://html5up.net">HTML5 UP</a>.</p>
                    </footer>

            </div>

        <div id="bg"></div>

        <script src="assets/js/jquery.min.js"></script>
            <script src="assets/js/browser.min.js"></script>
            <script src="assets/js/breakpoints.min.js"></script>
            <script src="assets/js/util.js"></script>
            <script src="assets/js/main.js"></script>

    </body>
</html> 