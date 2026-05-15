function handleLinkClick(e) {
  e.preventDefault();

  const page = this.dataset.page;
  const title = this.dataset.title;

  const links = document.querySelectorAll(".nav-link");
  links.forEach(function (link) {
    link.classList.toggle("active", link.dataset.page === page);
  });

  const content = document.getElementById("page-content");
  const xhr = new XMLHttpRequest();
  xhr.open("GET", "pages/" + page + ".php", true);

  xhr.onload = function () {
    if (xhr.status === 200 && content) {
      content.innerHTML = xhr.responseText;
      document.title = title || document.title;
      
    }
  };

  xhr.send();
}

function initDashboard() {
  const links = document.querySelectorAll(".nav-link[data-page]");
  links.forEach(function (link) {
    link.addEventListener("click", handleLinkClick);
  });
}

document.addEventListener("DOMContentLoaded", initDashboard);