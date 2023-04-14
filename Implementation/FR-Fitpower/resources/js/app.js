import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


const card = document.querySelector('#card');
const openCard = document.querySelectorAll('.toggele-card');
let open = false;

openCard.forEach(element => {
  element.addEventListener('click', () => {
    if (!open) {
      card.style.left = "0";
      open = true;
    } else {
      card.style.left = "100%";
      open = false;
    }
  })
});



const loginForm = document.querySelector('#login');
const closeLoginForm = document.querySelector('#close-login');
const openLoginForm = document.querySelector('#open-login');

if (loginForm != null && closeLoginForm != null && openLoginForm != null) {
  openLoginForm.addEventListener('click', () => {
    loginForm.style.display = 'flex'
    document.body.style.overflowY = "hidden"
  })
  closeLoginForm.addEventListener('click', () => {
    document.body.style.overflow = "unset"
    loginForm.style.display = 'none'
  })
}



// input files

let inputFile = document.getElementById('file-upload');
let container = document.getElementById('images-container');
let svg = document.getElementById('svg');

if (inputFile !== null) {
  inputFile.addEventListener('change', () => {
    container.innerHTML = '';
    if (inputFile.files.length > 4) { // check number of selected files
      alert("You can only upload a maximum of 4 images");
      return;
    }

    if (inputFile.files.length === 0) {
      svg.style.display = 'block';
      return;
    }

    for (const file of inputFile.files) {
      let reader = new FileReader();
      let img = document.createElement('img');

      reader.onload = () => {
        img.setAttribute("src", reader.result);
        img.setAttribute("width", '60');
        svg.style.display = 'none';
        container.appendChild(img);
      }
      reader.readAsDataURL(file);
    }
  });
}

let mainImage = document.querySelector('#main-image');

let preview = document.querySelectorAll('.preview');

preview.forEach(element => {
  element.addEventListener('click', (event) => {
    let targetImg = event.target;
    console.log(targetImg.getAttribute("src"));
    mainImage.setAttribute("src", targetImg.getAttribute("src"))
  })
});


