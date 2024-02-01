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
3. W folderze projektu, w terminalu `composer install` w celu instalacji zaleznosci `vendor`.
4. Włączyć XAMPP MySQL Database oraz Apache Web Server
5. Migracja bazy danych: `php artisan migrate`
6. W celu utworzenia bazy danych wybrać opcję: `Would you like to create it? Yes`. Enter. Baza danych zostanie utworzona.
7. Wczytywanie przykładowych danych: `php artisan db:seed`
8. Po uruchomieniu serwera, w terminalu `npm run dev`
9. W nowym oknie terminala: `php artisan serve`
10. Strona dostępna jest pod adresem: `localhost:8000`

## Troubleshooting
1. W przypadku kiedy nie wyświetlają się zdjęcia, zalecane jest wykonanie komendy w terminalu : `php artisan storage:link` w celu zlinkowania storage/app/public z public/storage

## Baza danych (przykładowe dane)

Utworzona baza danych zawiera odpowiadajace konta:

-   **Admin**
    -   Login: admin@admin.com
    -   Hasło: Administrator
-   **Test**
    -   Login: test@test.com
    -   Hasło: KontoTest11
-   **Wojciech Ross**
    -   Login: wojciech.ross@wr.com
    -   Hasło: WojRoss123
-   **Agnieszka Niemieszka**
    -   Login: agnieszka.niemieszka@an.com
    -   Hasło: AgnieszkaNiemieszka123

## Dodatkowe informacje

Projekt dostępny jest tez na profilu: **[GITHUB](https://github.com/Krrystian/laravel-example)**
