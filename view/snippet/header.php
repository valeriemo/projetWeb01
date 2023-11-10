<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="description" content="Découvrez tous les timbres en enchères du fameux Lord Stampee." />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- ICI CA VA CHANGER DYNAMIQUEMENT -->
  <title>Lord Stampee | {{title}}</title>
  <link rel="stylesheet" href="{{path}}assets/css/style.css" />
  <script defer src="{{path}}assets/scripts/main.js"></script>
</head>

<body>
  <!-- Navigation desktop -->
  <nav class="nav-desktop">
    <header class="nav-head">
      <div class="search-bar">
        <picture><img loading="lazy" src="{{path}}assets/img/svg/icone/search.svg" alt="loupe de recherche" /></picture>
        <input placeholder="Que cherchez-vous ?" type="search" aria-label="rechercher sur le site" />
        <button class="button-1 variation">Rechercher</button>
      </div>
      <div>
        <div class="texte-icone">
          <a href="#">$ CAN</a>
          <img loading="lazy" src="{{path}}assets/img/svg/icone/fleche-down-light.svg" alt="icone fleche" />
        </div>

        <div class="texte-icone">
          <picture>
            <img loading="lazy" src="{{path}}assets/img/svg/icone/worldwide.svg" alt="icone globe" />
          </picture>
          <a href="#">Francais</a>
          <img loading="lazy" src="{{path}}assets/img/svg/icone/fleche-down-light.svg" alt="icone fleche" />
        </div>

        {% if guest == 1 %}
        <a class="button-2" href="{{path}}membre/login">Se connecter</a>
        <a href="{{path}}membre/create">Créer un compte</a>
        {% else %}
        <a class="button-2" href="{{path}}membre/logout">Se déconnecter</a>
        <a href="{{path}}membre/index" class="icone-style-1">
          <div></div>
          <picture data-panier>
            <img loading="lazy" src="{{path}}assets/img/svg/icone/home_1.svg" alt="maison icone" />
          </picture>
        </a>
        {% endif %}
        <a href="" class="icone-style-1">
          <div></div>
          <picture data-panier>
            <img loading="lazy" src="{{path}}assets/img/svg/icone/panier-achat-dark.svg" alt="panier achat icone" />
          </picture>
        </a>
      </div>
    </header>

    <a href="{{path}}index.php">
      <picture>
        <img src="{{path}}assets/img/svg/logo/logo-blk.svg" alt="logo lord stampee" />
      </picture>
    </a>
    <div class="nav-principale">
      <div>
      <div class="dropdown">
          <div class="texte-icone">
          <a href="" aria-label="Page portail enchères">Enchères</a>
            <img loading="lazy" src="{{path}}assets/img/svg/icone/fleche-down-dark.svg" alt="icone fleche" />
          </div>
          <div class="dropdown-content">
            <a href="{{path}}enchere/show">En cours</a>
            <a href="{{path}}enchere/archive">Archive</a>
          </div>
        </div>
        <a href="#" aria-label="Page du Lord">Lord Reginald Stampee</a>
        <div class="dropdown">
          <div class="texte-icone">
            <a aria-label="Page actualités" href="#">Actualités </a>
            <img loading="lazy" src="{{path}}assets/img/svg/icone/fleche-down-dark.svg" alt="icone fleche" />
          </div>
          <div class="dropdown-content">
            <a href="#">Timbres</a>
            <a href="#">Enchères</a>
            <a href="#">Bridge</a>
          </div>
        </div>
        <a href="#" aria-label="Page du Lord">Fonctionnement</a>

        <div class="dropdown">
          <div class="texte-icone">
            <a aria-label="page conseils santé" href="#">Contact</a><img loading="lazy" src="{{path}}assets/img/svg/icone/fleche-down-dark.svg" alt="icone fleche" />
          </div>
          <div class="dropdown-content">
            <a href="#">Angleterre</a>
            <a href="#">Canada</a>
            <a href="#">USA</a>
            <a href="#">Australie</a>
          </div>
        </div>
      </div>
    </div>
  </nav>

  <!-- Navigation mobile -->
  <nav class="nav-mobile">
    <header class="nav-head">
      <div>
        {% if guest == 1 %}
        <a class="button-2" href="{{path}}membre/login">Se connecter</a>
        <a href="{{path}}membre/create">Créer un compte</a>
        {% else %}
        <a class="button-2" href="{{path}}membre/logout">Se déconnecter</a>
        <a href="{{path}}membre/index" class="icone-style-1">
          <div></div>
          <picture data-panier>
            <img loading="lazy" src="{{path}}assets/img/svg/icone/home_1.svg" alt="maison icone" />
          </picture>
        </a>
        {% endif %}
        <div class="icone-style-1">
          <div></div>
          <picture>
            <img loading="lazy" src="{{path}}assets/img/svg/icone/panier-achat-dark.svg" alt="panier achat icone" />
          </picture>
        </div>

      </div>
    </header>

    <div>
      <a href="{{path}}index.php">
        <picture>
          <img loading="lazy" src="{{path}}assets/img/svg/logo/logo-blk.svg" alt="logo lord stampee" />
        </picture>
      </a>

      <div class="burger" data-js-burger>
        <span class="burger__bar"></span>
        <span class="burger__bar"></span>
        <span class="burger__bar"></span>
      </div>
    </div>

    <div class="menu menu--ferme" data-js-menu>
      <div class="menu__ferme" data-js-menu-ferme></div>
      <nav>
        <ul class="menu__liste">
          <li><a href="{{path}}enchere/show">Enchères</a></li>
          <li><a href="#">Lord Reginald Stampee</a></li>
          <li>
            <div class="texte-icone">
              <a aria-label="Page actualités" href="#">Actualités </a>
              <picture><img loading="lazy" src="{{path}}assets/img/svg/icone/fleche-down-dark.svg" alt="icone fleche" /></picture>
            </div>
          </li>
          <li><a href="#">Fonctionnement</a></li>
          <li>
            <div class="texte-icone">
              <a aria-label="page conseils santé" href="#">Contact</a>
              <picture>
                <img loading="lazy" src="{{path}}assets/img/svg/icone/fleche-down-dark.svg" alt="icone fleche" />
              </picture>
            </div>
          </li>
        </ul>

        <div class="search-bar">
          <div>
            <picture><img loading="lazy" src="{{path}}assets/img/svg/icone/search.svg" alt="loupe de recherche" /></picture>
            <input placeholder="Que cherchez-vous ?" type="search" aria-label="rechercher sur le site" />
          </div>
          <button class="button-1 variation">Rechercher</button>
        </div>
      </nav>
    </div>
  </nav>