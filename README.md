# Tasks - Aplicació tasques 

> Aplicació de tasques feta a 2DAM curs 2018-2019

[![Captura pantalla](public/img/capturatasks.PNG)]()

- Captures de pantalla tasks



---

## Index

- [Instal·lació] (#installacio)
- [Documentació] (#documentacio)
- [Tests] (#tests)
- [Referències] (#referencies)

---

## Instal·lació

```bash
cd ~/Code
mdkir mimoun1997
cd mimoun1997/
git clone git@github.com:mimoun1997/tasks.git
cd tasks
npm install
composer install
cp .env.example .env # modificar les configuracions
php artisan key:generate
touch database/database.sqlite #Per a configuració sqlite
php artisan migrate --seed
php artisan passport:install
```



---

## Documentació

TODO

<a href="https://github.com/acacha/tasks">github acacha</a>

[Web acacha.org] (http://acacha.org/)


### Issues / Incidències
Tancar issues en commits paraules clau
````close, closes, closed, fixes, fixed #numero-issue````




---
## Tests

Per executar els testos
- php
```bash
phpunit
```
Executant phpunit en SO windows.
![Test](public/img/tests.gif)

- javascript
```bash
cd vue
npm run test:unit
```
---

## Referències

| Laravel                                                      | Vue                                                          | Vuetify                                                      | Tailwindcss                                                  |
| ------------------------------------------------------------ | ------------------------------------------------------------ | ------------------------------------------------------------ | ------------------------------------------------------------ |
| ![Laravel](https://camo.githubusercontent.com/5ceadc94fd40688144b193fd8ece2b805d79ca9b/68747470733a2f2f6c61726176656c2e636f6d2f6173736574732f696d672f636f6d706f6e656e74732f6c6f676f2d6c61726176656c2e737667) | <img width="100" src="https://vuejs.org/images/logo.png" alt="Vue logo"> | <img width="100" src="https://cdn.vuetifyjs.com/images/logos/logo.svg"> | <img width="200" src="https://tailwindcss.com/img/tailwind.svg"> |
