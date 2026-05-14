// Handle navigation link clicks - loads page content via AJAX
function handleLinkClick(e) {
  // Prevent default link behavior
  e.preventDefault();
  
  // Get the page name from the link's data attribute
  const page = this.dataset.page;
  
  // Get the page title from the link's data attribute
  const title = this.dataset.title;
  
  // Update active link indicator in sidebar
  const links = document.querySelectorAll('.nav-link');
  links.forEach(link => link.classList.remove('active'));
  this.classList.add('active');

  // Create AJAX request to fetch the page
  const xhr = new XMLHttpRequest();
  xhr.open('GET', 'pages/' + page + '.php', true);
  
  // When response is received, insert the content into the page
  xhr.onload = function () {
    if (xhr.status === 200) {
      // Update the page title
      const pageTitle = document.getElementById('page-title');
      pageTitle.textContent = title;
      
      // Update the page content
      const content = document.getElementById('page-content');
      content.innerHTML = xhr.responseText;

      if (page === 'Roomtype') {
        loadScriptOnce('/WebTechProject_G7/Assets/js/Roomtype.js', 'roomtype-js');
      }
    }
  };
  
  // Send the request
  xhr.send();
}

function loadScriptOnce(src, id) {
  if (document.getElementById(id)) {
    return;
  }
  const script = document.createElement('script');
  script.src = src;
  script.id = id;
  document.body.appendChild(script);
}

// Initialize the dashboard by attaching click handlers to all navigation links
function initDashboard() {
  // Get all navigation links
  const links = document.querySelectorAll('.nav-link');

  // Add click event listener to each link
  links.forEach(function (link) {
    link.addEventListener('click', handleLinkClick);
  });
}

// Run initialization when the page is fully loaded
document.addEventListener('DOMContentLoaded', initDashboard);