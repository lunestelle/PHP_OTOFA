setTimeout(function() {
  var flashMessage = document.getElementById('flash-message');
  if (flashMessage) {
    // Prevent scrolling during the transition
    document.body.style.overflow = 'hidden';

    // Slide out to the right
    flashMessage.style.transition = 'right 1.5s ease-out';
    flashMessage.style.right = '-30%';

    // After the transition duration, hide the element and allow scrolling
    setTimeout(function() {
      flashMessage.style.display = 'none';
      document.body.style.overflow = 'auto';
    }, 1500);
  }
}, 3000);