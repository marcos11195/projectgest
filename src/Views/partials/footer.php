<!-- BOOTSTRAP JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function toggleComentario(id) {
        const div = document.getElementById("comentario-" + id);
        const link = document.getElementById("vermas-" + id);

        if (div.classList.contains("comentario-corto")) {
            div.classList.remove("comentario-corto");
            link.textContent = "Ver menos";
        } else {
            div.classList.add("comentario-corto");
            link.textContent = "Ver más";
        }
    }
</script>

</body>

</html>