const formComentarios = document.querySelectorAll(".formComentario");
formComentarios.forEach((formComentario, pos) =>
  formComentario.addEventListener("submit", async (e) => {
    e.preventDefault();
    const postId = parseInt(document.querySelectorAll("#postId")[pos].value);
    const comment = document.querySelectorAll("#comentario")[pos].value;
    const author_id = parseInt(JSON.parse(localStorage.getItem("userBlog")).id);

    const response = await fetch("./api/comentario.php", {
      method: "POST",
      body: JSON.stringify({
        post_id: postId,
        content: comment,
        author_id: author_id,
      }),
    });

    const data = await response.json();

    console.log(data);
  })
);
