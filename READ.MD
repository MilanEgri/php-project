# Php - Boardgame Database

## Funkciók

### Regisztráció oldal
    Regisztrálás a köcetkező adatokkal:
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
    Regisztráció után MySQL ben az usernél az
    admin taget át kell állítani 0 ról 1 re.
### Home oldal
    Nem belépett és belépett usereknek
        - Társasok listázva , társas nevére
          kattintás esetén társas oldalára navigálás
        - Oldal tetejés szűrő név alapján
    Belépet Adminoknak
        - Társasok melett szerzektés és törlés gomb
        - Oldal tetjén társas hozzáadás gomb
### Társas oldal
    Nem belépett felhasználóknak
        - Társasról összes adat és kép
        - Előbbiek letöltése PDF be
        - Commentek megtekintése
    Belépett felhasználónak
        - Comment írás és saját comment törlése
    Belépett Adminoknak
        - Összes comment törlése
### Társasjáték léterhozása (csak adminoknak)
    - Adatok és kép feltöltése társasról
### Társasjáték szerkeztése (csak adminok)
    - Összes adat és kép cserélhető
### Profil szerkeztése (csak belépetteknek)
    - összes adat és profilkép cseréje
    - profil törlése
        
## Oldal locális összerakása
    
0. Szükséges programok:
    - MAMP,XAMP,LAMP VAGY PHP 8.1 és apache 2.0
    - PHP MySql
    
1. fájlok letöltése

```git@github.com:MilanEgri/php-project.git```
2. Php MySQL ben adatbázis létrehozása tetszőleges névvel
3.  ```php-project.sql``` importálása a létrehozott adatbázisba
4.  ```_config.php``` adatok kitöltése
5.  ```_config.php``` átnevezése ```config.php``` ra
