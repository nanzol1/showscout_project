# Követelmény specifikáció

## 1. Jelenlegi helyzet leírása

Jelenleg nincs központi online platform, amely az összes szükséges adatot tartalmazza a magyarországi filmekről és sorozatokról. A felhasználók több különböző oldalról gyűjthetnek információkat, beleértve a filmek és sorozatok adatlapjait, értékeléseket és keresési lehetőségeket. Az információk széttagoltsága nehézkessé teszi a keresést és a gyors tájékozódást a legnépszerűbb filmekről és sorozatokról.

## 2. Vágyálom rendszer leírása

A cél egy olyan weboldal létrehozása, ahol felhasználók filmek és sorozatok részletes adataihoz férhetnek hozzá egy helyen. A rendszer szűrési lehetőségeket biztosít, hogy a felhasználók gyorsan megtalálják a számukra releváns tartalmakat. A vágyálom rendszer lehetővé teszi a felhasználók számára az adatok böngészését, szűrését.

## 3. A rendszerre vonatkozó pályázat, törvények, rendeletek, szabványok és ajánlások felsorolása

•	Adatvédelmi jogszabályok: Az Európai Unió általános adatvédelmi rendelete (GDPR) betartása, különös figyelemmel a felhasználói adatok kezelésére.

•	Szerzői jogi előírások: A szerzői jogi törvények betartása, különös tekintettel a filmekhez, sorozatokhoz tartozó képek és leírások felhasználására.

•	W3C webes szabványok: Az oldal kialakításakor a W3C HTML és CSS szabványok figyelembevétele a kompatibilitás érdekében.

•	WCAG 2.1: A weboldal akadálymentesítésére vonatkozó irányelvek teljesítése a hozzáférhetőség biztosítása érdekében.

•	Ajánlások és bevált gyakorlatok: Felhasználói élmény (UX) és felhasználói felület (UI) tervezési alapelvek alkalmazása.

## 4. Jelenlegi üzleti folyamatok modellje:

  1. Filmek hozzáadása: Új lap benyújtása Wikipedián/IMDb-n, azonban moderátori engedély szükséges.
  2. Filmek adatai összegyűjtése: Pl. Wikipedia+IMDb-ről összeollózva
  3. Filmek adatainak módosítása: Módosítások benyújtása Wikipedián/IMDb-n, azonban moderátori engedélyre kell várni.
  4. Filmek törlése: Törölni cask Wikipedia/IMDb staff tud, ezért velük kell manuálisan kapcsolatba lépni.

## 5. Igényelt üzleti folyamatok modellje:

  1. Filmek hozzáadása: Belépés a ShowScout adminisztrátori felületére, ahonnan közvetlenül lehet hozzáadni.
  2. Filmek adatainak módosítása: Admin fiókba bejelentkezve, adott film oldalát felkeresve megjelenik egy módosítás gomb, ahonnan könnyen módosítható.
  3. Filmek törlése: A ShowScout adminisztátori felületéről egy gombnyomással törölhető, azonban előtte biztonsági okokból megkérdezi az oldal, hogy biztos szeretnéd-e törölni.
     
## 6. Követelménylista

1.	Felhasználói regisztráció és bejelentkezés: Lehetővé kell tenni a felhasználók számára a regisztrációt és bejelentkezést a profiladatok mentésére és kezelésére.
2.	Film- és sorozatadatok megjelenítése: Minden tartalom részletes adatlapja jelenjen meg, beleértve a címet, megjelenési évet, leírást, műfajt, típust.
3.	Szűrési lehetőségek: Szűrők, például műfaj, év, típus, megjelenés dátuma.
4.	Adminisztrátori jogosultságok: Az adminisztrátorok kezelhetik frissíthetik az adatbázist.
5.	Profilkezelés: A felhasználók frissíthetik a saját profiljukat.
6.	Adatbiztonság: Biztosítani kell a felhasználói és tartalmi adatok titkosítását és védelmét.
    
## 7. Fogalomszótár

•	Adatbázis: Olyan rendszer, amely tárolja a filmek, sorozatok és felhasználói adatokat.

•	Adminisztrátor: A rendszer üzemeltetője, aki jogosult a tartalmak moderálására, és a felhasználói tartalmak kezelésére.

•	Bejelentkezés: Felhasználói folyamat, amely során a regisztrált felhasználók beléphetnek a rendszerbe.

•	Felhasználó: A rendszer azon látogatói, akik böngészik az oldal tartalmát, értékeléseket és kommentárokat hagyhatnak.

•	Szűrés: A tartalom kiválasztásának lehetősége meghatározott paraméterek, például műfaj, év, értékelés szerint.

