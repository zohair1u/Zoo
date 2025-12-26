// DARK MODE : 

//   const toggleButton = document.getElementById('toggle-darkmode');
//   const icon = document.getElementById('icon-darkmode');

//   // Appliquer le mode selon localStorage
//   if (localStorage.getItem('theme') === 'dark') {
//     document.body.classList.add('dark-mode');
//     icon.src = '/images/sun-icon.png';
//     icon.alt = 'Activer le mode clair';
// }

//   toggleButton.addEventListener('click', () => {
//     document.body.classList.toggle('dark-mode');
//     const isDark = document.body.classList.contains('dark-mode');
//     localStorage.setItem('theme', isDark? 'dark': 'light');

//     icon.src = isDark? '/images/sun-icon.png': '/images/moon-icon.png';
//     icon.alt = isDark? 'Activer le mode clair': 'Activer le mode sombre';
// });

const toggleButton = document.getElementById('toggle-darkmode');
const icon = document.getElementById('icon-darkmode');

// Fonction pour appliquer le thème en fonction du stockage local
function applyTheme() {
  const theme = localStorage.getItem('theme');
  if (theme === 'dark') {
    document.body.classList.add('dark-mode');
    icon.src = '/images/sun-icon.png';
    icon.alt = 'Activer le mode clair';
  } else {
    document.body.classList.remove('dark-mode');
    icon.src = '/images/moon-icon.png';
    icon.alt = 'Activer le mode sombre';
  }
}

// Appliquer le thème au chargement de la page
applyTheme();

toggleButton.addEventListener('click', () => {
  document.body.classList.toggle('dark-mode');
  const isDark = document.body.classList.contains('dark-mode');
  localStorage.setItem('theme', isDark ? 'dark' : 'light');
  icon.src = isDark ? '/images/sun-icon.png' : '/images/moon-icon.png';
  icon.alt = isDark ? 'Activer le mode clair' : 'Activer le mode sombre';
});