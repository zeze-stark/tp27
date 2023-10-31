if (localStorage.getItem("userBlog")) {
  const user = JSON.parse(localStorage.getItem("userBlog"));

  document.querySelector("#username").textContent = user.username
  document.querySelector(".logged").classList.add("d-flex")
  document.querySelector(".noLogged").classList.add("d-none")
  console.log(user);
}else{
  document.querySelector(".logged").classList.add("d-none")
  document.querySelector(".noLogged").classList.add("d-flex")
}
