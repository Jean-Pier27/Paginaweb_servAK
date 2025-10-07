const fondo = document.getElementById('background');
const imagenes = [
  'https://img.freepik.com/foto-gratis/equipo-limpieza-profesional-trabajando-oficina_23-2149370017.jpg',
  'https://img.freepik.com/foto-gratis/hombre-limpiando-piso-oficina_23-2148888407.jpg',
  'https://img.freepik.com/foto-gratis/empleados-limpieza-uniformes-limpiando-oficina_23-2149392219.jpg',
  'https://img.freepik.com/foto-gratis/mujer-limpieza-profesional-limpiando-escritorio_23-2148888460.jpg'
];
let index = 0;

function cambiarFondo() {
  fondo.style.backgroundImage = `url('${imagenes[index]}')`;
  index = (index + 1) % imagenes.length;
}

cambiarFondo();
setInterval(cambiarFondo, 6000);

window.addEventListener('scroll', () => {
  const offset = window.scrollY * 0.3;
  fondo.style.transform = `translateY(${offset}px) scale(1.05)`;
});
