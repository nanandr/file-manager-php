const img = document.getElementById('images');

let toggle = true;
img.addEventListener('click', function(){
  toggle = !toggle;
  if(toggle){
    img.src = '..\\assets\\img\\1.png';
  }
  else{
    img.src = '..\\assets\\img\\2.png';
  }
});