# Vegan Shop
Jednostavan web-shop projekat.

Projekat je veoma jednostavan i ne prati sve sigurnosne mere.
Ukoliko želite da ga podignete u lokalu potrebno je samo da imate Docker i Docker Compose.

Pokrenuti sa: `docker compose up`

Projekat će biti pokrenut na: `http://localhost`

MailHog servis za presretanje mail-ova se nalazi na: `http://localhost:8025`

- 2 vrste korisnika + guest mode
- Slanje mejlova za verifikaciju, i potvrdu porudžbine
- Cart system za dodavanje i brisanje proizvoda iz korpe za ulogovane korisnike
- Admin može da verifikuje, banuje i da postavlja druge korisnike kao admine
- Admin može da dodaje, briše i uređuje proizvode
- Resetovanje šifre u slučaju zaboravljene šifre
- Korisnik može da kreira i briše šoping liste i da dodaje i uklanja proizvode sa liste
