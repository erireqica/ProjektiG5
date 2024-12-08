document.getElementById('contactForm').addEventListener('submit', function(event) {
    event.preventDefault();
  
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const message = document.getElementById('message').value;
    const responseMessage = document.getElementById('responseMessage');
  
    if (!name || !email || !message) {
      responseMessage.textContent = "All fields are required!";
      responseMessage.style.color = "red";
      responseMessage.classList.remove('hidden');
      return;
    }
  
    responseMessage.textContent = "Thank you, your message has been sent!";
    responseMessage.style.color = "green";
    responseMessage.classList.remove('hidden');
  
    document.getElementById('contactForm').reset();
  });
  