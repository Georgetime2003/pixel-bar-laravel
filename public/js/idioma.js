// Carrega dinàmicament els fitxers de traducció JSON i inicialitza i18next
const defaultLang = 'en';
const supportedLangs = ['en', 'ca'];

function loadLocale(lang) {
  return fetch(`/locales/${lang}.json`)
    .then(res => res.json())
    .catch(() => ({}));
}

function updateContent() {
  document.querySelectorAll('[data-i18n]').forEach(el => {
    const key = el.getAttribute('data-i18n');
    el.textContent = i18next.t(key);
  });
}

function setSelectedLang(lang) {
  const langMap = {
    en: 'EN', ca: 'CA', es: 'ES', fr: 'FR', ds: 'DE'
  };
  const flagMap = {
    en: '/img/flags/en.svg',
    ca: '/img/flags/ca.svg',
    es: '/img/flags/es.svg',
    fr: '/img/flags/fr.svg',
    ds: '/img/flags/de.svg'
  };
  const selectedLang = document.getElementById('selected-lang');
  if (selectedLang) {
    selectedLang.textContent = langMap[lang] || lang.toUpperCase();
    const img = selectedLang.previousElementSibling;
    if (img && img.tagName === 'IMG') {
      img.src = flagMap[lang] || '/img/flags/globe.svg';
    }
  }
}

function changeLanguage(lang) {
  loadLocale(lang).then(resources => {
    i18next.init({
      lng: lang,
      debug: false,
      resources: {
        [lang]: { translation: resources }
      }
    }, () => {
      updateContent();
      setSelectedLang(lang);
      // Desa la selecció d'idioma a localStorage
      localStorage.setItem('lang', lang);
    });
  });
}

document.addEventListener('DOMContentLoaded', function() {
  // Llegeix l'idioma desat o, si no hi és, detecta el del navegador
  let savedLang = localStorage.getItem('lang');
  if (!savedLang) {
    const navLang = navigator.language || navigator.userLanguage;
    // Només accepta idiomes suportats, sinó posa 'en'
    const langCode = navLang ? navLang.slice(0,2).toLowerCase() : 'en';
    const supported = ['en','ca','es','fr','ds'];
    savedLang = supported.includes(langCode) ? langCode : 'en';
  }
  changeLanguage(savedLang);
  // Només afegeix listeners si existeixen els botons (per compatibilitat amb el dropdown modern)
  const btns = ['en', 'ca', 'fr', 'es', 'ds'];
  btns.forEach(function(lang) {
    const btn = document.getElementById('btn-' + lang);
    if (btn) {
      btn.onclick = function() { changeLanguage(lang); };
    }
  });
  document.querySelectorAll('.dropdown-content a[data-lang]').forEach(function(a) {
    a.onclick = function(e) {
      e.preventDefault();
      changeLanguage(this.getAttribute('data-lang'));
    };
  });
  // Tancar el menú d'idiomes automàticament en seleccionar un idioma (mòbil i escriptori)
  (function() {
    var dropdown = document.querySelector('.dropdown');
    var dropbtn = document.querySelector('.dropbtn');
    var dropdownContent = document.querySelector('.dropdown-content');
    if (!dropdown || !dropbtn || !dropdownContent) return;
    dropdownContent.querySelectorAll('a[data-lang]').forEach(function(link) {
        link.addEventListener('click', function() {
            dropdownContent.style.display = 'none';
            dropdown.classList.remove('show');
        });
    });
    dropbtn.addEventListener('click', function(e) {
        e.preventDefault();
        var isVisible = dropdownContent.style.display === 'block';
        dropdownContent.style.display = isVisible ? 'none' : 'block';
    });
    document.addEventListener('click', function(e) {
        if (!dropdown.contains(e.target)) {
            dropdownContent.style.display = 'none';
        }
    });
  })();
  // Millora: Dropdowns d'idioma múltiples
  document.querySelectorAll('.dropdown').forEach(function(dropdown) {
    const dropbtn = dropdown.querySelector('.dropbtn');
    const dropdownContent = dropdown.querySelector('.dropdown-content');
    if (!dropbtn || !dropdownContent) return;
    dropbtn.addEventListener('click', function(e) {
      e.preventDefault();
      // Tanca altres dropdowns
      document.querySelectorAll('.dropdown-content').forEach(function(dc) {
        if (dc !== dropdownContent) dc.style.display = 'none';
      });
      dropdownContent.style.display = dropdownContent.style.display === 'block' ? 'none' : 'block';
    });
    dropdownContent.querySelectorAll('a[data-lang]').forEach(function(link) {
      link.addEventListener('click', function() {
        dropdownContent.style.display = 'none';
        dropdown.classList.remove('show');
      });
    });
    document.addEventListener('click', function(e) {
      if (!dropdown.contains(e.target)) {
        dropdownContent.style.display = 'none';
      }
    });
  });
});
