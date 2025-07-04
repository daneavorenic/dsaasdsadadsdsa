 // Появление при скролле
 const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add("animate");
      }
    });
  }, {
    threshold: 0.2
  });

  document.querySelectorAll(".hexIn").forEach(el => {
    observer.observe(el);
  });