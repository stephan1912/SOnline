let mainNav = document.getElementById('js-menu');
let navBarToggle = document.getElementById('js-navbar-toggle');

navBarToggle.addEventListener('click', function () {
    
    mainNav.classList.toggle('nav-active');
});

window.onscroll = function() {navBarScrollFunc()};

var navbar = document.getElementById("navigationBar");
var sticky = navbar.offsetTop;

function navBarScrollFunc() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky")
  } else {
    navbar.classList.remove("sticky");
  }
}

function doXmlRequest(tip, url, callback, data) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        callback(this.responseText);
      }
    };
    xhttp.open(tip, url, true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(data);
  }

function createModal(_header, _content, _footer){
    var prev = document.getElementById("modalElement");
    if(prev != null) prev.remove();
    var modal = document.createElement('div');
    modal.className = "modal";
    var content = document.createElement('div');
    content.className = "modal-content";
    modal.appendChild(content);

    var header = document.createElement('header');
    header.className = "modal-header";
    var close = document.createElement('span');
    close.className = "close";
    close.innerHTML = "&times;";
    close.onclick = function() {
        modal.style.display = "none";
      }
    header.appendChild(close);
    header.appendChild(_header); 
    content.appendChild(header);
    
    var body = document.createElement('section');
    body.className = "modal-body";
    body.appendChild(_content); 
    content.appendChild(body);

    var footer = document.createElement('footer');
    footer.className = "modal-footer";
    footer.appendChild(_footer); 
    content.appendChild(footer);

    modal.id = "modalElement";
    modal.style.display = "block";
    document.body.appendChild(modal);
}