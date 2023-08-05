const box = document.getElementById('book');

box.addEventListener('mouseover', function handleMouseOver() {
  box.innerText = 'YES NOW!';
});
box.addEventListener('mouseleave', function handleMouseleave() {
    box.innerText = 'Book Now';
  });