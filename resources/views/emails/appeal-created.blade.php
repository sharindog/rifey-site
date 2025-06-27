<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Ваше обращение принято</title>
</head>
<body>
<h1>Ваше обращение №{{ $appeal->id }} принято</h1>
<p>Добрый день!</p>
<p>Мы получили ваше обращение и зарегистрировали его под номером <strong>№{{ $appeal->id }}</strong>.</p>
<p>Текст вашего обращения:</p>
<blockquote>{{ $appeal->body }}</blockquote>
<p>Спасибо за обращение! Мы свяжемся с вами в ближайшее время.</p>
</body>
</html>
