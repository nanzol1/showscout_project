![image](https://github.com/user-attachments/assets/b5bc2fab-3391-4755-96b4-6c8d8eeaac09)# Funkcionális specifikáció
## Adminisztrátori user story:
A ShowScout csapata szeretne egy oldalt, ahova a megjelent filmeket/sorozatokat tudják felvinni, hogy egy helyen megtalálhatóak legyenek a filmek/sorozatok adatai. Mikor sikeresen belépnek az admin felületre, megfelelő autentikáció után, akkor szeretnék, hogy tudjanak új filmeket felvenni, meglévő filmek adatait módosítani, továbba filmeket törölni. 
## Felhasználói user story:
A felhasználó szeretne egy filmet vagy sorozatot nézni, de nincs ötlete mit, ezért meglátogatja a ShowScout oldalát. Itt a szűrök segítségével a saját érdelődési körére szűrheti a megjelenő filmeket/sorozatokat és így könnyebben választani tud, hogy mit nézzen.

# Képernyőtervek:
## Regisztrációs oldal:
![image](https://github.com/user-attachments/assets/7b43f7c7-6cb2-4e2c-a00a-2bca6c9abe80)

Oldal fő funkciója: Új felhasználó regisztrációja

Oldal tartalma:

-A regisztrációhoz szükséges információknak a felhasználó által kitölthető form, melyben a mezők megfelelő ellenőrzéssel rendelkeznek.          
-Beküldés gomb, melyre rányomva a form elküldésre kerül a szerver felé, ahol elkészül az új felhasználó.
## Bejelentkezési oldal:
![image](https://github.com/user-attachments/assets/33ac85ce-9618-40d9-b54c-366179fc5a10)

Oldal fő funkciója: Meglévő felhasználó bejelentkeztetése

Oldal tartalma:

-A regisztráció során a felhasználó által megadott bejelentkezési adatokhoz tartozó form.          
-Belépés gomb, melyre rányomva a form elküldésre kerül a szerver felé, ahol ellenőrzésre kerülnek a megadott belépési adatok, és ha azokhoz tartozik aktív felhasználó akkor az beléptetésre kerül.
## Főoldal:
![image](https://github.com/user-attachments/assets/381a0089-276b-4c8b-a236-cf1c35e59987)

Oldal fő funkciója: Film feed megtekintése

Oldal tartalma:

-Listában megjelenő filmek/sorozatok, melyekhez tartozik egy borítókép, egy cím, egy megjelenési dátum, egy leírás, illetve műfaj és, hogy film vagy sorozat.   
-Szűrő, ahol műfaj, típus, dátum és szolgáltató alapján szűrhetőek a megjelenő sorozatok/filmek.   
-A filmre/sorozatra kattintva elérhető a film/sorozat saját oldala, ahol bővebb információk találhatóak róla.
## Profile oldal:
![image](https://github.com/user-attachments/assets/30090eac-77bf-4813-98b7-65b6ede3090c)


Oldal fő funkciója: Bejelentkezett felhasználó kezelőoldala

Oldal tartalma:

-A felhasználó regisztrációs adatait tartalmazó form, ami megjeleníti a jelenlévő adatokat, és ahonnan módosíthatja a felhasználó.
## Admin felület:
![image](https://github.com/user-attachments/assets/62c28b8a-76e9-4978-9fca-c17909bc50f1)

Oldal fő funkciója: Oldal működésénék és tartalmának követése és módosítása admin felhasználók által

Oldal tartalma:

-Egy táblázat mely tartalmazza a létrehozott felhasználók, azok nevét, emailjét, szerepkörét, regisztrálási dátumát, illetve egy törlés gombot, amely az adott felhasználó törlésére használható.  
-Egy táblázat mely tartalmazza a létrehozott filmeket/sorozatokat, azok nevét, URL-ét, illetve egy törlés gombot, amely az adott film törlésére használható.  
-Egy panel mely tartalmazza az adott pillanatban létező felhasználók számát.  
-Egy panel mely tartalmazza az adott pillanatban létező filmek/sorozatok számát.  
-Egy form, amivel egy emailt és egy jelszót megadva admin felhasználó hozható létre.  
-Egy form, amivel új film adható hozzá, annak részleteinek megadásával.
