# 🧠 TO DO LIST

Mała apka webowa do ogarniania zadań.  
Pisane w czystym PHP (bez frameworków, bo to projekt bardziej edukacyjny niż produkcyjny).  
Baza danych leci na PostgreSQL, a frontend to prosty HTML+CSS (trochę dopieszczony dla oka, ale bez rakiety).  

## 🔧 Co to robi?

- Rejestracja i logowanie użytkowników (z hashowaniem, nie martw się, nie trzymam plaintextów jak amator)
- Dodawanie i usuwanie zadań (dla zalogowanego usera – każdy ma swoje)
- Prosty dashboard
- Responsywny wygląd (ale bez cudów, to nie Tailwind tylko CSS od serca)
- Obsługa błędów (jak coś się sypie, to nie rzuca ci białą stroną śmierci)
- Wszystko działa przez sesje i PDO (bo mysqli to rak)

## 💻 Technologia

- **PHP** – backend
- **PostgreSQL** – baza danych (chociaż łatwo można by to przerobić na MySQL jakby ktoś się uparł)
- **HTML + CSS** – frontend
- **AJAX (planowane)** – do ogarnięcia dynamicznego dodawania/usuwania tasków bez przeładowania

## 📁 Co tu siedzi w środku?

- **index.php** – główna strona na start. Masz tu logowanie i rejestrację. Jak wjedziesz na dashboard bez zalogowania, to i tak Cię wywali.
- **todolist.php** – dashboard z listą zadań. Odpala się dopiero po zalogowaniu. Wszystko ładnie pokazane w tabelkach, bez kombinowania.
- **db.php** – połączenie z bazą danych przez PDO. Nie wrzucam go do repo, bo tam są dane logowania (no i to lokalna baza, ale wiadomo, ostrożności nigdy za wiele).

---

## 🧠 Logika aka "API"

Te pliki ogarniają backendową magię. Nie mają frontu, tylko dostają dane i coś z nimi robią:

- **/api/login.php** – sprawdza, czy użytkownik istnieje, czy hasło się zgadza i jak tak, to loguje.
- **/api/register.php** – rejestracja nowego usera, wrzuca dane do bazy. Jak coś nie pasi (np. user już istnieje), to wywala błąd.
- **/api/addTask.php** – dodaje zadanie do bazy. Przesyłasz tekst zadania, on leci do tabelki.
- **/api/removeTask.php** – usuwa zadanie z bazy, ale musisz podać ID taska. Nie zgadnie za Ciebie.

---

📌 Wszystkie akcje są oparte na **POST**, jak przystało na klasyczne PHP-owe podejście.

💡 Pliki API spokojnie można ogarnąć AJAXem w przyszłości, jak się zachce trochę dynamicznego JS-a.

## 👤 Autor

Projekt zrobiony przez **Dominika Ładnowskiego** (aka Łysy / Zakolak) – ucznia technikum, który lubi klepać backend w PHP, a frontem też nie pogardzi jak trzeba.  
Jak masz pytanie albo chcesz się pośmiać z kodu razem – śmiało pisz!

📬 Kontakt: [dominik.ladnowski@outlook.com](#)

🐙 GitHub: [github.com/domi385](https://github.com/domi385)

📸 Instagram: [[instagram.com](https://www.instagram.com/domino29127/)]
