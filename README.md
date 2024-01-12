## Projekt

Projekt został wykonany na zaliczenie laboratorium "Podstawy Aplikacji Internetowych".
Do wykonania projektu uzyto frameworku full-stack: Laravel.
Po stronie serwera baza danych: MySQL (z panelem administracyjnym phpmyadmin), ORM: Eloquent.
Po stronie klienta: Vite, Laravel Blade, TailwindCSS, Toastr (wiadomości).

## Wymagania

Podane nizej wersje programów byly wykorzystane do tworzenia aplikacji, aplikacja nie została przetestowana z kompatybilnością wcześniejszych wersji.

-   XAMPP (MySQL Database, APACHE Web Server)
-   PHP 8.3.x
-   Composer 2.6.6
-   Laravel Framework 10.38.1
-   Node 21.5.0

## Uruchomienie

1. Plik projektowy `laravel-example` nalezy umieścić w `XAMPP\htdocs`.
2. W folderze projektu, w terminalu `npm install` w celu instalacji zaleznosci `node_modules`.
3. Włączyć XAMPP MySQL Database oraz Apache Web Server
4. Migracja bazy danych: `php artisan migrate`
5. W celu utworzenia bazy danych wybrać opcję: `Would you like to create it? Yes`. Enter. Baza danych zostanie utworzona.
6. Po uruchomieniu serwera, w terminalu `npm run dev`
7. W nowym oknie terminala: `php artisan serve`
8. Strona dostępna jest pod adresem: `localhost:8000`

## Dodatkowe informacje

Projekt dostępny jest tez na profilu: **[GITHUB](https://github.com/Krrystian/laravel-example)**
