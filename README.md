# showscout_project
A project futtatásához szükség lesz házi apache és mysql szerver futtatására ezt a XAMPP, vagy WAMPP segítségével lehet megtenni.
Ha a XAMPP programot választjuk akkor a klónozott projectet el kell helyeznünk a xampp/htdocs mappában.
![image](https://github.com/user-attachments/assets/6393bf1d-c118-4f4b-8e36-a8668871f243)
Fontos! Mivel a vendor mappa nem kerül feltöltésre a git-re ezáltal minden cloneozás után kell egy composer install-t futtatni a project-root mappán belül.
Ezután elérjük a weboldalt az adott linken keresztül: http://localhost/sorozatfilm_project/showscout_project/project-root/public/

Ha nem sikerül a composer install akkor bizonyosodj meg hogy le van töltve a legfrissebb php-d
https://www.php.net/
Ha ez megvan akkor töltsd le a composert is
https://getcomposer.org/
Ha ez is megvan akkor a letöltött php-dba van egy php.ini konfigurációs file, abban meg kell keresned a
;extension=intl (Azt hiszem ezt, de írni fogja a hibánál)
Innen ki kell szedni a ; -jelet és utána zárd be a console-t és elvileg jónak kell lennie a composer installnak, vagy update-nek.
