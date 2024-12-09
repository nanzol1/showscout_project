# Rendszerterv
## 1. Felhasznált technológiák
- **Frontend/Backend**: CodeIgniter 4(PHP) 
- **Adatbázis**: MySQL

## 2. Funkciók
- **Főoldal**: Filmek listája, megjelenéssel, streaming szolgáltatóval, rövid leírással, valamint műfajjal és típussal.
- **Részletes nézet**: Egy adott film/sorozat minden adatának megjelenítése.
- **Profilnézet**: Az adott felhasználó regisztrációkor megadott adatainak megjelenítése.
- **Adminfelület**: Filmek oldalának létrehozása, szerkesztése, törlése.

## 3. Adatfolyam
- A **felhasználók** lekérik a filmeket a backendtől, amely SQL-lekérdezéseket hajt végre az mySQL-adatbázisból.
- Az **adminisztrátorok** a adminisztrációs felületén keresztül kezelik a filmeket.

## 4. Osztálydiagram  
![TOYNRI~1](https://github.com/user-attachments/assets/90fe5876-f1c6-4d71-a0a9-cdea361464c7)
