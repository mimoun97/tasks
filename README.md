<div align="center">
    <p>
        <h1>
            <a href="https://tasks.mimoun1997.scool.cat/">
            <img src="resources/img/icons/icon-512x512.png" height="256" alt="Tasks"/>
            </a>
            <br/>
            Tasques M97
        </h1>
        <h4>Aplicació de tasques feta a 2DAM curs 2018-2019</h4>
    </p>
    <p>
        <a href="https://tasks.mimoun1997.scool.cat/" target="_blank" rel="noopener noreferrer">
            <img width="100" src="https://scrutinizer-ci.com/g/mimoun1997/tasks/badges/quality-score.png?b=master" alt="Scrutinizer Code Quality" />
        </a>
        <a>
            <img width="100" src="https://scrutinizer-ci.com/g/mimoun1997/tasks/badges/build.png?b=master" alt="Build Status" />
        </a>
        <a>
            <img width="100" src="https://scrutinizer-ci.com/g/mimoun1997/tasks/badges/code-intelligence.svg?b=master" alt="Code Intelligence Status" />
        </a>
        <a>
            <img width="100" src="https://github.styleci.io/repos/154520137/shield?branch=master" alt="StyleCI" />
        </a>
    </p>
</div>


<div align="center">
    <p>
        <h2>Previsualització</h2>
        <img align="left" src="./resources/img/preview.gif" alt="Captura" />
    	<img align="right" src="./resources/img/preview2.gif" alt="Captura" />
    </p>
</div>

---

## Index

- [Instal·lació] (#instal·lació)
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

- php
```bash
phpunit
```

<p align="center">
	<img src="public/img/tests.gif" alt="Tests" />
</p>

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


## TODO
- [x] efecte ripple: https://vuetifyjs.com/en/directives/ripples
- [x] rendiment ligthhouse
- [ ] wepb i html5 element `<picture>`
- [x] webpack -> production
- [x] minificació
- [x] CDN vs import fonts?
- [x] bg images from https://www.pexels.com/
- [ ] link compartir tasca

+ tips for performance [The Cost Of JavaScript](https://medium.com/dev-channel/the-cost-of-javascript-84009f51e99e)