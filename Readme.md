# Php - Boardgame Database

##### 🇬🇧English below

## Funkciók

### Regisztráció oldal
    Regisztráció a következő adatokkal:
        - Felhasználónév (kötelező)
        - Email (kötelező)
        - Jelszó (kötelező)
        - Jelszó megerősítése (kötelező)
        - Profilkép feltöltése (nem kötelező)
            - ha nem tölt fel képet placeholder
              avatar image
        - Google reCAPTCA megerősítés (kötelező)
### Belépés oldal
        Bejelentkezés következő adatokkal:
            - Felhasználónév (kötelező)
            - Jelszó (kötelező)
### Admin rang
    Regisztráció után MySQL-ben az felhasználónál az
    admin taget át kell állítani 0-ról 1-re.
### Home oldal
    Nem bejelentkezett és bejelentkezett felhasználóknak
        - Társasjátékok listázva , társasjáték nevére
          kattintás esetén társas oldalára navigálás
        - Oldal tetején szűrő név alapján
    Bejelentkezett adminoknak
        - Társasjátékok mellett szerkesztésés törlés gomb
        - Oldal tetején társasjáték hozzáadás gomb
### Társasjáték oldal
    Nem bejelentkezett felhasználóknak
        - Társasjátékokról összes adat és kép
        - Adatok letöltése PDF-be
        - Kommentek megtekintése
    Belépett felhasználónak
        - Komment írás és saját komment törlése
    Belépett Adminoknak
        - Összes komment törlése
### Társasjáték létrehozása(csak adminoknak)
    - Adatok és kép feltöltése társasról
### Társasjáték szerkeztése (csak adminok)
    - Összes adat és kép cserélhető
### Profil szerkesztése (csak belépetteknek)
    - összes adat és profilkép cseréje
    - profil törlése
        
## Oldal locális összerakása
    
0. Szükséges programok:
    - MAMP,XAMP,LAMP VAGY PHP 8.1 és apache 2.0
    - PHP MySql
    - Google cloud profil
    
1. fájlok letöltése

```git@github.com:MilanEgri/php-project.git```
2. Php MySQL ben adatbázis létrehozása tetszőleges névvel

3.  ```php-project.sql``` importálása a létrehozott adatbázisba
4.  ```_config.php``` adatok kitöltése

    !Fontos a console.cloud.google.com on be kell állítani a localhost domain nevet az oldalhoz tartozó profilhoz.
5.  ```_config.php``` átnevezése ```config.php``` ra



##### 🇭🇺Hungarian above

## Features

### Registration Page
   Registration with the following details:
   - Username (mandatory)
   - Email (mandatory)
   - Password (mandatory)
   - Password confirmation (mandatory)
   - Upload Profile Picture (optional)
     - If no picture is uploaded, a placeholder avatar image will be used
   - Google reCAPTCHA verification (mandatory)
        
### Login Page
   Login with the following details:
   - Username (mandatory)
   - Password (mandatory)
            
### Admin Rank
   After registration, in MySQL, the admin tag for the user must be changed from 0 to 1.
    
### Home Page
   For both non-logged-in and logged-in users:
   - Boardgames listed, clickable by game name to navigate to the game page
   - Filter by game name at the top of the page
   For logged-in admins:
   - Edit and delete buttons alongside boardgames
   - Add boardgame button at the top of the page
        
### Boardgame Page
   For non-logged-in users:
   - Display of all data and images for boardgames
   - Download data in PDF format
   - View comments
   For logged-in users:
   - Write and delete own comments
   For logged-in admins:
   - Delete all comments
        
### Creating Boardgames (admins only)
   - Upload data and images for a boardgame
    
### Editing Boardgames (admins only)
   - All data and images are editable
    
### Profile Editing (logged-in users only)
   - Edit all data and profile picture
   - Delete profile
    
## Local Setup
    
0. Necessary programs:
   - MAMP, XAMP, LAMP or PHP 8.1 and Apache 2.0
   - PHP MySQL
   - Google Cloud profile
    
1. Download files:
   ```git@github.com:MilanEgri/php-project.git```
   
2. Create a database in PHP MySQL with any name.
   
3. Import `php-project.sql` into the created database.
   
4. Fill in the details in `_config.php`.
   Important: Set the localhost domain name in console.cloud.google.com for the corresponding profile.
   
5. Rename `_config.php` to `config.php`.

