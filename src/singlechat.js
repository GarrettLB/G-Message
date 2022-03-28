let chatBox = document.querySelector("#chat-box")
let form = document.querySelector("#messageForm")
let messageInput = document.querySelector("#messageInput")
let typeArea = document.querySelector("#type-area")
let chatName = document.querySelector("#chatName")

let loc = window.location.href
let split = loc.split("=")

const getName = () => {
  const xhttp = new XMLHttpRequest();
  xhttp.open("GET", `includes/getname.inc.php?id=${split[1]}`, true);
  xhttp.onload = function() {
    let data = xhttp.response
    chatName.innerHTML = "Chat With "+data
  } 
  xhttp.send();
};

getName();

form.onsubmit = (event) => {
  event.preventDefault();
  const xhttp = new XMLHttpRequest();
  xhttp.open("POST", "includes/messages.inc.post.php", true);
  let formData = new FormData(form)
  xhttp.send(formData);
  scrollToBottom();

  messageInput.value = ""
};

chatBox.onmouseenter = () => {
  chatBox.classList.add("active")
}

chatBox.onmouseleave = () => {
  chatBox.classList.remove("active")
}

setInterval(() => {
  const xhttp = new XMLHttpRequest();
  xhttp.open("GET", `includes/messages.inc.get.php?id=${split[1]}`, true);
  xhttp.onload = function() {
    let data = xhttp.response
    chatBox.innerHTML = data
    if (!chatBox.classList.contains("active")) {
      scrollToBottom();
    };
  } 
  xhttp.send();
  
},500);

const scrollToBottom = () => {
  chatBox.scrollTop = chatBox.scrollHeight;
};