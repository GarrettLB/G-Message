let  userList= document.querySelector("#user-list")
let form = document.querySelector("#userForm")
let userSearch = document.querySelector("#userSearch")

function removeAllChildNodes(parent) {
  while (parent.firstChild) {
    parent.removeChild(parent.firstChild);
  }
}

const loadLocalStorage = () => {
  removeAllChildNodes(userList);

  let convos = JSON.parse(localStorage.getItem("conversations"))

  if (convos) {
    for (let convo of convos) {
      let split = convo.split("-")

      let newA = document.createElement('a')
      newA.textContent = split[0]
      newA.href = `./singlechat.php?user=${split[1]}`
      newA.classList.add("userA")

      let newLi = document.createElement('li')
      newLi.classList.add("userLi")

      let newDiv = document.createElement('div')
      newDiv.classList.add("userDiv")

      userList.appendChild(newDiv)
      newDiv.appendChild(newLi)
      newLi.appendChild(newA)
    }
  }
};

loadLocalStorage();

form.onsubmit = (event) => {
  event.preventDefault();
  const xhttp = new XMLHttpRequest();
  xhttp.open("POST", "includes/users.inc.get.php", true);
  xhttp.onload = function() {
    let data = xhttp.response

    // handling localStorage
    if (data !== "No user with that name!") {
      let conversations = JSON.parse(localStorage.getItem("conversations"))

      if (conversations) {
        if (conversations.includes(data)) {
          alert("You already have a conversation with this user!")
        } else {
        let newConvo = [data, ...conversations]
        localStorage.setItem("conversations", JSON.stringify(newConvo))
        loadLocalStorage();
        }
      } else {
        let newConvo = []
        newConvo.push(data)
        localStorage.setItem("conversations", JSON.stringify(newConvo))
        loadLocalStorage();
      }
    } else {
      alert(data)
    }
  } 
  let formData = new FormData(form)
  xhttp.send(formData);

  userSearch.value = ""
};